

```python
import getpass

CLEARMASH_CLIENT_TOKEN=getpass.getpass('CLEARMASH_CLIENT_TOKEN:')
```

    CLEARMASH_CLIENT_TOKEN: ································



```python
REQUEST_HEADERS = {
    "ClientToken": CLEARMASH_CLIENT_TOKEN,
    "PersonToken": "no_token",
    "SystemToken": "no_token",
    "Content-Type": "application/json"
}
```


```python
import requests
from IPython.core.display import display, HTML

res = requests.get(
    'https://bh.clearmash.com/API/V5/Services/Search.svc//Search?Query={query}&NumberOfResult={numOfResults}'.format(
        query=input("query: "),
        numOfResults=input("numOfResults: ")
    ),
    headers=REQUEST_HEADERS
)

display(HTML(res.text))
```

    query:  ethiopian
    numOfResults:  5



{"ErrorInfo":null,"Response":{"Entities":[8429620,14041532,238025,260098,249189],"EntitiesCurrentPageIsLastRelevantPage":false,"EntityTypes":[],"ErrorMessage":null,"FacetFieldResults":[],"QueryRelatedTagIds":[],"Tags":[],"TotalEntities":1392,"TotalTags":0},"Status":0}



```python
res = requests.get('https://bh.clearmash.com/API/V5/Services/Search.svc/Search/Saved', headers=REQUEST_HEADERS)
ethiopian_family_names_saved_search = [s for s in res.json()['Response'] if s['Name'] == 'Ethiopian family names for jewish spotlight'][0]
```


```python
res = requests.post(
    'https://bh.clearmash.com/API/V5/Services/Search.svc/Search/Saved/Execute', 
    json={
        'SearchId': ethiopian_family_names_saved_search['Id'],
        'PageNumber': 1,
        'PageSize': 10,
        'CommunityId': ethiopian_family_names_saved_search['CommunityId']
    },
    headers=REQUEST_HEADERS
)

display(HTML(res.text))
```


{"ErrorInfo":"unknown error","Response":null,"Status":1}
