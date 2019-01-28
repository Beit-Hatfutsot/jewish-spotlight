from dataflows import Flow, update_resource
from jewish_spotlight_dataflows.common_flows import run_dump_print
from jewish_spotlight_dataflows.cached_apis import load_cached_api

# this flow parses cached bhs api response and stores as a datapackage which can be used as base for generating data
# it should not run again, unless you want to update the data from the old BHS api (which you shouldn't need to)

raise Exception('flow is kept for reference but should not run again')

if __name__ == '__main__':
    run_dump_print(
        Flow(
            load_cached_api('bhjs-content/places/ethiopia/cached-api.php'),
            update_resource('res_1', name='ethiopia-cached-api', path='ethiopia-cached-api.csv')
        ),
        'data/parse_cached_apis'
    )
