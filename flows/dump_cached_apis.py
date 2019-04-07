from dataflows import Flow, load, add_field
from jewish_spotlight_dataflows.common_flows import run_dump_print
from jewish_spotlight_dataflows.cached_apis import dump_cached_api
from tabulator import Stream

# parses the datapackage under data/parse_cached_apis
# it gets the resource for ethiopeia and generates the cached-api.php file which is used by the frontend


def add_ethiopia_familynames(rows):
    if rows.res.name == 'ethiopia-cached-api':
        for row in rows:
            if row['UnitType'] != 6:
                yield row
        with Stream('data/ethiopia/familynames-13022019.csv', headers=1) as stream:
            for row in stream.iter(keyed=True):
                yield {
                    'UnitType': 6,
                    'UnitTypeDesc': 'Family Name',
                    'header_en': row['Name'],
                    'header_he': '',
                    'text_en': '',
                    'text_he': '',
                    'slug_en': 'familyname_' + row['Name'].lower(),
                    'slug_he': '',
                    'video_url': '',
                    'main_image_url': '',
                    'preview_image_url': '',
                    'image_urls': [],
                    'item_url_he': '',
                    'item_url_en': row['URL']
                }
    else:
        yield from rows


if __name__ == '__main__':
    run_dump_print(
        Flow(
            load('data/parse_cached_apis/datapackage.json'),
            add_field('item_url_he', 'string'),
            add_field('item_url_en', 'string'),
            add_ethiopia_familynames,
            dump_cached_api('czeck-cached-api', 'bhjs-content/places/czech/cached-api.php'),
            dump_cached_api('ethiopia-cached-api', 'bhjs-content/places/ethiopia/cached-api.php'),
        ),
        'data/dump_cached_apis',
        fields=['UnitType', 'UnitTypeDesc', 'header_en', 'header_he'],
        num_rows=1,
        resources=['ethiopia-cached-api']
    )
    print('Saved updated cached-api.php files in bhjs-content/places/*/cached-api.php')
