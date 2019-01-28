from dataflows import Flow, load
from jewish_spotlight_dataflows.common_flows import run_dump_print
from jewish_spotlight_dataflows.cached_apis import dump_cached_api

# parses the datapackage under data/parse_cached_apis
# it gets the resource for ethiopeia and generates the cached-api.php file which is used by the frontend

if __name__ == '__main__':
    run_dump_print(
        Flow(
            load('data/parse_cached_apis/datapackage.json'),
            dump_cached_api('czeck-cached-api', 'bhjs-content/places/czech/cached-api.php'),
            dump_cached_api('ethiopia-cached-api', 'bhjs-content/places/ethiopia/cached-api.php'),
        ),
        'data/dump_cached_apis',
        fields=['UnitType', 'UnitTypeDesc', 'header_en', 'header_he'],
        num_rows=1,
        resources=['ethiopia-cached-api']
    )
    print('Saved updated cached-api.php file in bhjs-content/places/ethiopia/cached-api.php')
