import json


def _get_picture_url(picture_id):
    return f'https://storage.googleapis.com/bhs-flat-pics/{picture_id}.jpg'


def load_cached_api(json_filename):
    def _load_cached_api():
        with open(json_filename) as f:
            for item in json.load(f)['items']:
                preview_image_url = None
                image_urls = []
                for picture in item['Pictures']:
                    picture_id = picture.get('PictureId')
                    if picture_id:
                        picture_url = _get_picture_url(picture['PictureId'])
                        image_urls.append(picture_url)
                        if picture.get('IsPreview') == '1':
                            preview_image_url = picture_url
                yield {
                    'UnitType': item['UnitType'],
                    'UnitTypeDesc': item['UnitTypeDesc'],
                    'header_en': item['Header']['En'],
                    'header_he': item['Header']['He'],
                    'text_en': item['UnitText1']['En'],
                    'text_he': item['UnitText1']['He'],
                    'slug_en': item['Slug']['En'],
                    'slug_he': item['Slug']['He'],
                    'video_url': item.get('video_url'),
                    'main_image_url': item.get('main_image_url'),
                    'preview_image_url': preview_image_url,
                    'image_urls': image_urls,
                    'item_url_he': '',
                    'item_url_en': ''
                }

    return _load_cached_api()


def dump_cached_api(resource_name, json_filename):
    data = {'items': []}

    def _dump_cached_api(rows):
        for row in rows:
            yield row
            if rows.res.name == resource_name:
                data['items'].append({
                    'UnitType': row['UnitType'],
                    'UnitTypeDesc': row['UnitTypeDesc'],
                    'Header': {
                        'He': row['header_he'],
                        'En': row['header_en'],
                    },
                    'UnitText1': {
                        'He': row['text_he'],
                        'En': row['text_en'],
                    },
                    'Slug': {
                        'He': row['slug_he'],
                        'En': row['slug_en'],
                    },
                    'video_url': row['video_url'],
                    'main_image_url': row['main_image_url'],
                    'preview_image_url': row['preview_image_url'],
                    'image_urls': row['image_urls'],
                    'item_url_he': row.get('item_url_he', ''),
                    'item_url_en': row.get('item_url_en', ''),
                })
        with open(json_filename, 'w') as f:
            json.dump(data, f)

    return _dump_cached_api
