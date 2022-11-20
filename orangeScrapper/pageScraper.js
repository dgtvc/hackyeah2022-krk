const fs = require('fs');

const scraperObject = {
    url1: 'https://salony.orange.pl/pl/l/Polska?cl.zones=zone_1',
    step: 1,
    click: 0,
    date: false,
    async scraper(browser) {
        if (!this.date) {
            const currentDate = new Date();
            this.date = currentDate.getDate() + "-"
                + (currentDate.getMonth()+1)  + "-"
                + currentDate.getFullYear() + " "
                + currentDate.getHours() + ":"
                + currentDate.getMinutes() + ":"
                + currentDate.getSeconds()
        }

        let page = await browser.newPage();
        console.log(`Navigating to ${this.url1}...`);
        page.on('response', async response => {
            if (response.url().includes('OEPL_pl')) {
                console.log(response.url());
            }
            if (response.url().includes('OEPL_pl') && this.step > 1 && response.request().method() !== 'OPTIONS') {
                await this.parse(response);
                await this.loadMore(page);
			}
        });
        await page.goto(this.url1);

        await page.waitForSelector('[class="map-box__content__show-filters"]', {
          visible: true,
        });

        await page.click('[class="map-box__content__show-filters"]');
        this.step = 2;

        await page.waitForSelector('a[class="filters__header__reset nuxt-link-active"]', {
          visible: true,
        });

        await page.click('a[class="filters__header__reset nuxt-link-active"]');

        this.step = 3;

        await page.waitForSelector('button[class="page-search__board__content__close lpe-icons"]', {
          visible: true,
        });

        await page.click('[class="page-search__board__content__close lpe-icons"]');
    },
    async loadMore(page) {
        await this.sleep(500);

        this.click++;

        console.log('Scrolling into');

        const [button] = await page.$x('//*[@id="feedScroll"]/div/section[1]/button');
        await page.evaluate((element) => { element.scrollIntoView(); }, button);

        console.log('Loading more...');

        await this.sleep(1000);

        await page.waitForSelector('button[class="page-search__feed__more__content"]', {
          visible: true,
        });

        await page.click('button[class="page-search__feed__more__content"]');

        console.log('Clicked');
    },
    async parse(response) {
        const data = await response.json();

        fs.writeFile(`data/${this.date}-${this.click}.json`, JSON.stringify(data.hits), function(err) {
            if(err) {
                return console.log(err);
            }
        });
    },
    async sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
}

module.exports = scraperObject;