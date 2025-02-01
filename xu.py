import time
import requests
import asyncio
import json
from telegram import Update
from telegram.ext import Application, CommandHandler, MessageHandler, filters, CallbackContext

# Lưu các token và trạng thái của bot
user_tokens = {}
check_active = {}
previous_balance = {}  # Lưu số dư trước của từng token

# URL server để kiểm tra token
url = "https://vipig.net/logintoken.php"
headers = {
    "Content-Type": "application/x-www-form-urlencoded"
}

async def start(update: Update, context: CallbackContext):
    """Bot sẽ yêu cầu người dùng nhập số lượng token khi bắt đầu, xóa token cũ nếu có"""
    user_id = update.message.from_user.id

    # Xóa các token cũ của người dùng
    if user_id in user_tokens:
        del user_tokens[user_id]
        del check_active[user_id]
        del previous_balance[user_id]  # Xóa số dư cũ
        await update.message.reply_text("Các token cũ đã được xóa. Vui lòng nhập số lượng token mới:")

    else:
        await update.message.reply_text("Chào bạn! Vui lòng nhập số lượng token bạn muốn nhập:")

async def handle_message(update: Update, context: CallbackContext):
    """Xử lý thông tin người dùng nhập vào"""
    user_id = update.message.from_user.id
    message = update.message.text

    # Kiểm tra xem người dùng đã nhập số lượng token chưa
    if user_id not in user_tokens:
        try:
            num_tokens = int(message)
            user_tokens[user_id] = {'num_tokens': num_tokens, 'tokens': []}
            check_active[user_id] = False
            await update.message.reply_text(f"Bạn muốn nhập {num_tokens} token. Vui lòng nhập token vào:")
        except ValueError:
            await update.message.reply_text("Vui lòng nhập một số hợp lệ.")
    elif len(user_tokens[user_id]['tokens']) < user_tokens[user_id]['num_tokens']:
        user_tokens[user_id]['tokens'].append(message)
        if len(user_tokens[user_id]['tokens']) == user_tokens[user_id]['num_tokens']:
            await update.message.reply_text("Bạn đã nhập đủ token. Nhập lệnh /xu để kiểm tra.")
        else:
            await update.message.reply_text(f"Đã lưu {len(user_tokens[user_id]['tokens'])} token, còn {user_tokens[user_id]['num_tokens'] - len(user_tokens[user_id]['tokens'])} token nữa.")
    else:
        await update.message.reply_text("Bạn đã nhập đủ số token. Nhập lệnh /xu để kiểm tra.")

async def xu(update: Update, context: CallbackContext):
    """Xử lý lệnh /xu để bắt đầu kiểm tra token"""
    user_id = update.message.from_user.id
    if user_id not in user_tokens or len(user_tokens[user_id]['tokens']) == 0:
        await update.message.reply_text("Bạn chưa nhập token nào. Vui lòng nhập token trước.")
        return

    if check_active[user_id]:
        await update.message.reply_text("Kiểm tra đang hoạt động rồi.")
        return

    check_active[user_id] = True
    await update.message.reply_text("Đang bắt đầu kiểm tra token. Mỗi 120 giây sẽ gửi một kết quả.")

    while check_active[user_id]:
        if not check_active[user_id]:  # Kiểm tra flag dừng
            break  # Dừng ngay vòng lặp nếu có lệnh /stop

        for token in user_tokens[user_id]['tokens']:
            # Gửi yêu cầu POST đến server
            data = {"access_token": token}
            response = requests.post(url, headers=headers, data=data)

            if response.status_code == 200:
                try:
                    # Parse JSON và lấy user cùng số dư
                    response_data = response.json()
                    user = response_data['data']['user']
                    current_balance = float(response_data['data']['sodu'])  # Trích xuất số dư từ JSON
                    
                    # Lấy số dư trước của token từ previous_balance
                    previous = previous_balance.get(token, None)

                    # Tính sự thay đổi số dư cho token
                    if previous is not None:
                        change = current_balance - previous
                        result = f"User: {user}\nSố dư mới: {current_balance} (Sự thay đổi: {change})"
                    else:
                        result = f"User: {user}\nSố dư mới: {current_balance} (Lần kiểm tra đầu tiên)"
                    
                    # Cập nhật số dư trước của token
                    previous_balance[token] = current_balance

                except (ValueError, KeyError):
                    result = "Dữ liệu trả về không hợp lệ hoặc không có số dư."
            else:
                result = f"Kiểm tra token thất bại. Mã lỗi: {response.status_code}"

            # Gửi kết quả đến Telegram (không hiển thị token)
            await context.bot.send_message(chat_id=user_id, text=result)

        # Sử dụng asyncio.sleep để không làm gián đoạn việc xử lý các lệnh khác
        await asyncio.sleep(120)

async def stop(update: Update, context: CallbackContext):
    """Dừng kiểm tra khi người dùng nhập /stop"""
    user_id = update.message.from_user.id
    check_active[user_id] = False
    await update.message.reply_text("Kiểm tra đã dừng lại.")

def main():
    """Khởi tạo bot và các handler"""
    application = Application.builder().token("7793179088:AAF0RA5lsNy8pc-d5h6AnA5TyoV1h8qmcms").build()

    # Lệnh /start
    application.add_handler(CommandHandler("start", start))

    # Lệnh /xu để bắt đầu kiểm tra
    application.add_handler(CommandHandler("xu", xu))

    # Lệnh /stop để dừng kiểm tra
    application.add_handler(CommandHandler("stop", stop))

    # Xử lý tin nhắn
    application.add_handler(MessageHandler(filters.TEXT & ~filters.COMMAND, handle_message))

    application.run_polling()

if __name__ == '__main__':
    main()
