I thought using web scrapper using puppeteer would be the simplest solution, but what I needed to do, was to send simple curl:

curl --location --request POST 'https://0knemtbxx3-dsn.algolia.net/1/indexes/OEPL_pl/query?x-algolia-agent=Algolia%20for%20JavaScript%20(4.5.1)%3B%20Browser' \
--header 'x-algolia-api-key: 7a46160ed01bb0af2c2af8d14b97f3c5' \
--header 'x-algolia-application-id: 0KNEMTBXX3' \
--header 'Content-Type: application/json' \
--data-raw '{
    "query": "",
    "offset": 0,
    "length": 1000,
    "facets": [
        "customLists.services",
        "customLists.zones"
    ],
    "aroundLatLngViaIP": true
}'