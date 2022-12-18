import requests
import threading,sys
class Main:
    def buff():
        cookies = {
            'cf_chl_2': '65a1a8bbe83eead',
            'cf_clearance': 'MxxgEBTSDhK3Fpt6TZhRUZW1yvasZkqu2GujokQWL2E-1670748211-0-150',
}
        headers = {
            'authority': 'pagepro.xyz',
            'accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'accept-language': 'en-US,en;q=0.9',
            'cache-control': 'max-age=0',
            # 'cookie': 'cf_chl_2=65a1a8bbe83eead; cf_clearance=MxxgEBTSDhK3Fpt6TZhRUZW1yvasZkqu2GujokQWL2E-1670748211-0-150',
            'sec-ch-ua': '"Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"',
            'sec-ch-ua-mobile': '?0',
            'sec-ch-ua-platform': '"Windows"',
            'sec-fetch-dest': 'document',
            'sec-fetch-mode': 'navigate',
            'sec-fetch-site': 'same-origin',
            'sec-fetch-user': '?1',
            'upgrade-insecure-requests': '1',
            'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
        }

        params = {
            'id': '4',
        }

        response = requests.get('https://pagepro.xyz/api/index.php', params=params, cookies=cookies, headers=headers)
        print(response.json())
    def run_share():
                threa = 80
                while True:
                    t = threading.Thread(target=Main.buff)
                    t.start()
                    while threading.active_count() > threa:
                        t.join()
if __name__ == "__main__":
        Main.run_share()