---
title: TeamFlow v1.0
language_tabs:
  - javascript: JavaScript
  - php: PHP
language_clients:
  - javascript: ""
  - php: ""
toc_footers: []
includes: []
search: true
highlight_theme: darkula
headingLevel: 2

---

<!-- Generator: Widdershins v4.0.1 -->

<h1 id="teamflow">TeamFlow v1.0</h1>

> Scroll down for code samples, example requests and responses. Select a language for code samples from the tabs above or the mobile navigation menu.

Base URLs:

* <a href="http://teamfloa-be.gplans.it">http://teamfloa-be.gplans.it</a>

# Authentication

- HTTP Authentication, scheme: bearer 

<h1 id="teamflow-params">params</h1>

params

## params

`GET /`

> Example responses

> 200 Response

```json
{
  "limit": 0,
  "page": 0,
  "sortBy": "string",
  "sortValue": "string",
  "filterBy": "string",
  "filterValue": "string",
  "start": "string",
  "end": "string"
}
```

<h3 id="params-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|[sortFilterParams](#schemasortfilterparams)|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

<h1 id="teamflow-account">account</h1>

account

## Get all accounts data

<a id="opIdgetAllAccounts"></a>

`GET /api/account/all`

<h3 id="get-all-accounts-data-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|limit|query|integer|false|Limit of elements|
|page|query|integer|false|Current page|
|sortBy|query|string|false|sort by element|
|sortValue|query|string|false|sorting type|
|filterBy|query|string|false|fields to filter|
|filterValue|query|string|false|Values to filter|

> Example responses

> 200 Response

```json
{
  "data": [
    {
      "current_page": 1,
      "data": [
        {
          "id": "59e7626e-49bf-4e63-b195-f4d826af8ad8",
          "username": "agent",
          "name": "Luca",
          "surname": "La Porta",
          "email": "agent@dev.com"
        }
      ],
      "first_page_url": "http://localhost:8000/api/account/all?page=1",
      "from": 1,
      "last_page": 1,
      "last_page_url": "http://localhost:8000/api/account/all?page=1",
      "links": [
        {
          "url": "string",
          "label": "pagination.previous",
          "active": true
        }
      ],
      "next_page_url": "string",
      "path": "http://localhost:8000/api/account/all",
      "per_page": 10,
      "prev_page_url": "string",
      "to": 1,
      "total": 1
    }
  ],
  "message": "string"
}
```

<h3 id="get-all-accounts-data-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|

<h3 id="get-all-accounts-data-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[[AccountsResponse](#schemaaccountsresponse)]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Get all accounts usernames

<a id="opIdgetAllUsernames"></a>

`GET /api/accounts/username/all`

<h3 id="get-all-accounts-usernames-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|limit|query|integer|false|Limit of elements|
|page|query|integer|false|Current page|
|sortBy|query|string|false|sort by element|
|sortValue|query|string|false|sorting type|
|filterBy|query|string|false|fields to filter|
|filterValue|query|string|false|Values to filter|

> Example responses

> 200 Response

```json
{
  "data": [
    {
      "id": "a6ff9885-6166-4375-979a-bad6e2b4b9be",
      "username": "luca10"
    }
  ],
  "message": "string"
}
```

<h3 id="get-all-accounts-usernames-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|

<h3 id="get-all-accounts-usernames-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[[AccountsUsernames](#schemaaccountsusernames)]|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Get data of a single account

<a id="opIdgetAccount"></a>

`GET /api/account/{accountId}`

<h3 id="get-data-of-a-single-account-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|accountId|path|string|true|model id|

> Example responses

> 200 Response

```json
{
  "data": {
    "id": "59e7626e-49bf-4e63-b195-f4d826af8ad8",
    "username": "agent",
    "name": "Luca",
    "surname": "La Porta",
    "email": "agent@dev.com"
  },
  "message": "string"
}
```

<h3 id="get-data-of-a-single-account-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not Found|Inline|

<h3 id="get-data-of-a-single-account-responseschema">Response Schema</h3>

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Update a specific account

<a id="opIdupdateAccount"></a>

`PUT /api/account/{accountId}`

> Body parameter

```json
{
  "username": "john10",
  "name": "John",
  "surname": "Doe",
  "email": "johndow@email.com",
  "password": "abc1234"
}
```

<h3 id="update-a-specific-account-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|accountId|path|string|true|model id|
|body|body|[AccountBodyReq](#schemaaccountbodyreq)|true|JSON with account data|

> Example responses

> 200 Response

```json
{
  "data": [
    null
  ],
  "message": "Update Success"
}
```

<h3 id="update-a-specific-account-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Updated|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Bad request|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Inserted model not exists|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="update-a-specific-account-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[any]|false|none|none|
|» message|string|false|none|none|

Status Code **400**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Delete an existing account

<a id="opIddeleteAccount"></a>

`DELETE /api/account/{accountId}`

<h3 id="delete-an-existing-account-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|accountId|path|string|true|Account id|

> Example responses

> 200 Response

```json
{
  "data": [
    "string"
  ],
  "message": "Delete success"
}
```

<h3 id="delete-an-existing-account-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|success|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Bad request|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="delete-an-existing-account-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **400**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Get info of a single account

<a id="opIdgetAccountInfo"></a>

`GET /api/account/{accountId}/info`

<h3 id="get-info-of-a-single-account-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|accountId|path|string|true|model id|

> Example responses

> 200 Response

```json
{
  "data": {
    "name": "Luca",
    "surname": "La Porta"
  },
  "message": "string"
}
```

<h3 id="get-info-of-a-single-account-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not Found|Inline|

<h3 id="get-info-of-a-single-account-responseschema">Response Schema</h3>

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Create new account

<a id="opIdcreateAccount"></a>

`POST /api/account`

> Body parameter

```json
{
  "username": "john10",
  "name": "John",
  "surname": "Doe",
  "email": "johndow@email.com",
  "password": "abc1234"
}
```

<h3 id="create-new-account-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|body|body|[AccountBodyReq](#schemaaccountbodyreq)|true|JSON with account data|

> Example responses

> 201 Response

```json
{
  "data": {
    "id": "1a2d4d27-43d1-4450-9ed0-5c4e7b802dae"
  },
  "message": "Account created successfully"
}
```

<h3 id="create-new-account-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|201|[Created](https://tools.ietf.org/html/rfc7231#section-6.3.2)|Created|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Bad request|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="create-new-account-responseschema">Response Schema</h3>

Status Code **201**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|object|false|none|none|
|»» id|string|false|none|none|
|» message|string|false|none|none|

Status Code **400**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

<h1 id="teamflow-auth">auth</h1>

auth

## Login

<a id="opIdlogin"></a>

`POST /api/login`

Login with inserted credentials

> Body parameter

```json
{
  "username": "super",
  "password": "password"
}
```

<h3 id="login-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|body|body|object|true|JSON with account data|
|» username|body|string|false|none|
|» password|body|string|false|none|

> Example responses

> 200 Response

```json
{
  "data": {
    "status": "success",
    "accountId": "8a2f56c2-5b5f-4b3f-996c-1774f33415cb",
    "authorization": {
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzIwNDI3NDE1LCJleHAiOjE3MjEwMzIyMTUsIm5iZiI6MTcyMDQyNzQxNSwianRpIjoiYXlGakZMcFBmaWlZRFV4YSIsInN1YiI6IjhhMmY1NmMyLTViNWYtNGIzZi05OTZjLTE3NzRmMzM0MTVjYiIsInBydiI6ImM4ZWUxZmM4OWU3NzVlYzRjNzM4NjY3ZTViZTE3YTU5MGI2ZDQwZmMiLCJyb2xlIjoiYmNiMDk1YWEtYmRlNi00NTVhLWE4NDEtNzYxMWM0M2FmY2VhIn0.r1SGjTg7GpiJjiN778yU2NKv39c8G4WmMKJAs9lW_5A",
      "type": "bearer"
    }
  },
  "message": "string"
}
```

<h3 id="login-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="login-responseschema">Response Schema</h3>

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» status|string|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="success">
This operation does not require authentication
</aside>

## Logout

<a id="opIdlogout"></a>

`POST /api/logout`

logout with current account

> Example responses

> 200 Response

```json
{
  "data": [
    null
  ],
  "message": "Successfully logged out"
}
```

<h3 id="logout-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="logout-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[any]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» status|string|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Logged

<a id="opIdlogged"></a>

`GET /api/logged`

Check if user is logged

> Example responses

> 200 Response

```json
{
  "data": {
    "logged": true,
    "account": {
      "id": "59e7626e-49bf-4e63-b195-f4d826af8ad8",
      "username": "agent",
      "name": "Luca",
      "surname": "La Porta",
      "email": "agent@dev.com"
    }
  },
  "message": "string"
}
```

<h3 id="logged-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="logged-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Refresh

<a id="opIdrefresh"></a>

`POST /api/refresh`

Refresh token of current account

> Example responses

> 200 Response

```json
{
  "data": {
    "status": "success",
    "accountId": "8a2f56c2-5b5f-4b3f-996c-1774f33415cb",
    "authorization": {
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3JlZnJlc2giLCJpYXQiOjE3MjA0MjgyNjUsImV4cCI6MTcyMTAzMzA2NSwibmJmIjoxNzIwNDI4MjY1LCJqdGkiOiJyaEtabWt2eko0RmZCbDUyIiwic3ViIjoiOGEyZjU2YzItNWI1Zi00YjNmLTk5NmMtMTc3NGYzMzQxNWNiIiwicHJ2IjoiYzhlZTFmYzg5ZTc3NWVjNGM3Mzg2NjdlNWJlMTdhNTkwYjZkNDBmYyIsInJvbGUiOiJiY2IwOTVhYS1iZGU2LTQ1NWEtYTg0MS03NjExYzQzYWZjZWEifQ.A4JRY0cTfsn-aXJFJPPTk16ArAfdNN0FetKDcDpqrS8",
      "type": "bearer"
    }
  },
  "message": "string"
}
```

<h3 id="refresh-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="refresh-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|object|false|none|none|
|»» status|string|false|none|none|
|»» accountId|string|false|none|none|
|»» authorization|object|false|none|none|
|»»» token|string|false|none|none|
|»»» type|string|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» status|string|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

<h1 id="teamflow-comment">comment</h1>

comment

## Get comments from specific todo

<a id="opIdgetAllTodoComments"></a>

`GET /api/todo/{todoId}/comment/all`

<h3 id="get-comments-from-specific-todo-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|todoId|path|string|true|todo id|
|limit|query|integer|false|Limit of elements|
|page|query|integer|false|Current page|
|sortBy|query|string|false|sort by element|
|sortValue|query|string|false|sorting type|
|filterBy|query|string|false|fields to filter|
|filterValue|query|string|false|Values to filter|

> Example responses

> 200 Response

```json
{
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": "6ca498b0-3fb6-4094-ba16-42728383c587",
        "content": "Commento numero uno",
        "created_at": "2025-01-18 16:14:44",
        "updated_at": "2025-01-18 16:14:45",
        "todo_id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
        "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
        "account_username": "test"
      }
    ],
    "first_page_url": "http://host/request/all?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://host/request/all?page=1",
    "links": [
      {
        "url": "string",
        "label": "pagination.previous",
        "active": true
      }
    ],
    "next_page_url": "string",
    "path": "http://host/request/all",
    "per_page": 10,
    "prev_page_url": "string",
    "to": 1,
    "total": 1
  },
  "message": "string"
}
```

<h3 id="get-comments-from-specific-todo-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|[CommentsResponse](#schemacommentsresponse)|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|

<h3 id="get-comments-from-specific-todo-responseschema">Response Schema</h3>

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Get data of a single comment

<a id="opIdgetComment"></a>

`GET /api/comment/{commentId}`

<h3 id="get-data-of-a-single-comment-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|commentId|path|string|true|model id|

> Example responses

> 200 Response

```json
{
  "data": {
    "id": "6ca498b0-3fb6-4094-ba16-42728383c587",
    "content": "Commento numero uno",
    "created_at": "2025-01-18 16:14:44",
    "updated_at": "2025-01-18 16:14:45",
    "todo_id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
    "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
    "account_username": "test"
  },
  "message": "string"
}
```

<h3 id="get-data-of-a-single-comment-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not Found|Inline|

<h3 id="get-data-of-a-single-comment-responseschema">Response Schema</h3>

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Update a specific comment

<a id="opIdupdateComment"></a>

`PUT /api/comment/{commentId}`

> Body parameter

```json
{
  "content": "Commento di prova"
}
```

<h3 id="update-a-specific-comment-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|commentId|path|string|true|model id|
|body|body|[CommentBodyReq](#schemacommentbodyreq)|true|JSON with comment data|

> Example responses

> 200 Response

```json
{
  "data": [
    null
  ],
  "message": "Update Success"
}
```

<h3 id="update-a-specific-comment-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Updated|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Bad request|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Inserted model not exists|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="update-a-specific-comment-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[any]|false|none|none|
|» message|string|false|none|none|

Status Code **400**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Delete an existing comment

<a id="opIddeleteComment"></a>

`DELETE /api/comment/{commentId}`

<h3 id="delete-an-existing-comment-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|commentId|path|string|true|comment id|

> Example responses

> 200 Response

```json
{
  "data": [
    "string"
  ],
  "message": "Delete success"
}
```

<h3 id="delete-an-existing-comment-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|success|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Bad request|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="delete-an-existing-comment-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **400**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Create new comment in a specific todo

<a id="opIdcreateComment"></a>

`POST /api/todo/{todoId}/comment`

> Body parameter

```json
{
  "content": "Commento di prova"
}
```

<h3 id="create-new-comment-in-a-specific-todo-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|todoId|path|string|true|todo id|
|body|body|[CommentBodyReq](#schemacommentbodyreq)|true|JSON with comment data|

> Example responses

> 201 Response

```json
{
  "data": {
    "id": "1a2d4d27-43d1-4450-9ed0-5c4e7b802dae"
  },
  "message": "Insert success"
}
```

<h3 id="create-new-comment-in-a-specific-todo-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|201|[Created](https://tools.ietf.org/html/rfc7231#section-6.3.2)|Created|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Bad request|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="create-new-comment-in-a-specific-todo-responseschema">Response Schema</h3>

Status Code **201**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|object|false|none|none|
|»» id|string|false|none|none|
|» message|string|false|none|none|

Status Code **400**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

<h1 id="teamflow-todo">todo</h1>

todo

## Get all todos data

<a id="opIdgetAllTodos"></a>

`GET /api/todo/all`

<h3 id="get-all-todos-data-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|limit|query|integer|false|Limit of elements|
|page|query|integer|false|Current page|
|sortBy|query|string|false|sort by element|
|sortValue|query|string|false|sorting type|
|filterBy|query|string|false|fields to filter|
|filterValue|query|string|false|Values to filter|
|start|query|string|false|filter by date: start data|
|end|query|string|false|filter by date: end data|

> Example responses

> 200 Response

```json
{
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
        "title": "Andare in palestra",
        "description": "Ricorda la cintura",
        "note": "string",
        "category": "hobby",
        "checked": true,
        "created_at": "2024-10-26 15:40:00",
        "updated_at": "2024-10-26 15:40:00",
        "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
        "sharedWith": [
          {
            "id": "2d414d58-79d9-4b90-897f-d29889e86b98",
            "username": "account_test"
          }
        ],
        "isShared": true,
        "comments": [
          {
            "id": "6ca498b0-3fb6-4094-ba16-42728383c587",
            "content": "Commento numero uno",
            "created_at": "2025-01-18 16:14:44",
            "updated_at": "2025-01-18 16:14:45",
            "todo_id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
            "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
            "account_username": "test"
          }
        ]
      }
    ],
    "first_page_url": "http://localhost:8000/api/todo/all?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/todo/all?page=1",
    "links": [
      {
        "url": "string",
        "label": "pagination.previous",
        "active": true
      }
    ],
    "next_page_url": "string",
    "path": "http://localhost:8000/api/todo/all",
    "per_page": 10,
    "prev_page_url": "string",
    "to": 1,
    "total": 1
  },
  "message": "string"
}
```

<h3 id="get-all-todos-data-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|

<h3 id="get-all-todos-data-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»» first_page_url|string|false|none|none|
|»» from|number|false|none|none|
|»» last_page|number|false|none|none|
|»» last_page_url|string|false|none|none|
|»» links|[object]|false|none|none|
|»»» url|string(nullable)|false|none|none|
|»»» label|string|false|none|none|
|»»» active|boolean|false|none|none|
|»» next_page_url|string(nullable)|false|none|none|
|»» path|string|false|none|none|
|»» per_page|number|false|none|none|
|»» prev_page_url|string(nullable)|false|none|none|
|»» to|number|false|none|none|
|»» total|number|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Get all shared todos

<a id="opIdgetAllSharedTodos"></a>

`GET /api/todo/shared/all`

<h3 id="get-all-shared-todos-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|limit|query|integer|false|Limit of elements|
|page|query|integer|false|Current page|
|sortBy|query|string|false|sort by element|
|sortValue|query|string|false|sorting type|
|filterBy|query|string|false|fields to filter|
|filterValue|query|string|false|Values to filter|
|start|query|string|false|filter by date: start data|
|end|query|string|false|filter by date: end data|

> Example responses

> 200 Response

```json
{
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
        "title": "Andare in palestra",
        "description": "Ricorda la cintura",
        "note": "string",
        "category": "hobby",
        "checked": true,
        "created_at": "2024-10-26 15:40:00",
        "updated_at": "2024-10-26 15:40:00",
        "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
        "sharedWith": [
          {
            "id": "2d414d58-79d9-4b90-897f-d29889e86b98",
            "username": "account_test"
          }
        ],
        "isShared": true,
        "comments": [
          {
            "id": "6ca498b0-3fb6-4094-ba16-42728383c587",
            "content": "Commento numero uno",
            "created_at": "2025-01-18 16:14:44",
            "updated_at": "2025-01-18 16:14:45",
            "todo_id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
            "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
            "account_username": "test"
          }
        ]
      }
    ],
    "first_page_url": "http://localhost:8000/api/todo/all?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/todo/all?page=1",
    "links": [
      {
        "url": "string",
        "label": "pagination.previous",
        "active": true
      }
    ],
    "next_page_url": "string",
    "path": "http://localhost:8000/api/todo/all",
    "per_page": 10,
    "prev_page_url": "string",
    "to": 1,
    "total": 1
  },
  "message": "string"
}
```

<h3 id="get-all-shared-todos-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|

<h3 id="get-all-shared-todos-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|»» first_page_url|string|false|none|none|
|»» from|number|false|none|none|
|»» last_page|number|false|none|none|
|»» last_page_url|string|false|none|none|
|»» links|[object]|false|none|none|
|»»» url|string(nullable)|false|none|none|
|»»» label|string|false|none|none|
|»»» active|boolean|false|none|none|
|»» next_page_url|string(nullable)|false|none|none|
|»» path|string|false|none|none|
|»» per_page|number|false|none|none|
|»» prev_page_url|string(nullable)|false|none|none|
|»» to|number|false|none|none|
|»» total|number|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Get all todo accounts

<a id="opIdgetAllTodoAccounts"></a>

`GET /api/todo/{todoId}/accounts/all`

Get all accounts of a specific todo

<h3 id="get-all-todo-accounts-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|todoId|path|string|true|todo id|

> Example responses

> 200 Response

```json
{
  "data": [
    {
      "id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
      "username": "user_00"
    }
  ],
  "message": "string"
}
```

<h3 id="get-all-todo-accounts-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not Found|Inline|

<h3 id="get-all-todo-accounts-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[[TodoAccountsResponse](#schematodoaccountsresponse)]|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Get data of a single todo

<a id="opIdgetTodo"></a>

`GET /api/todo/{todoId}`

<h3 id="get-data-of-a-single-todo-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|todoId|path|string|true|todo id|

> Example responses

> 200 Response

```json
{
  "data": {
    "id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
    "title": "Andare in palestra",
    "description": "Ricorda la cintura",
    "note": "string",
    "category": "hobby",
    "checked": true,
    "created_at": "2024-10-26 15:40:00",
    "updated_at": "2024-10-26 15:40:00",
    "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
    "sharedWith": [
      {
        "id": "2d414d58-79d9-4b90-897f-d29889e86b98",
        "username": "account_test"
      }
    ],
    "isShared": true,
    "comments": [
      {
        "id": "6ca498b0-3fb6-4094-ba16-42728383c587",
        "content": "Commento numero uno",
        "created_at": "2025-01-18 16:14:44",
        "updated_at": "2025-01-18 16:14:45",
        "todo_id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
        "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
        "account_username": "test"
      }
    ]
  },
  "message": "string"
}
```

<h3 id="get-data-of-a-single-todo-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Ok|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not Found|Inline|

<h3 id="get-data-of-a-single-todo-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Update a specific todo

<a id="opIdupdateTodo"></a>

`PUT /api/todo/{todoId}`

> Body parameter

```json
{
  "title": "Todo di prova",
  "description": "descrizione di prova",
  "note": "nessuna nota",
  "category": "importanti",
  "checked": true
}
```

<h3 id="update-a-specific-todo-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|todoId|path|string|true|todo id|
|body|body|[TodoBodyReq](#schematodobodyreq)|true|JSON with todo data|

> Example responses

> 200 Response

```json
{
  "data": [
    null
  ],
  "message": "Update Success"
}
```

<h3 id="update-a-specific-todo-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Updated|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Bad request|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Inserted model not exists|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="update-a-specific-todo-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[any]|false|none|none|
|» message|string|false|none|none|

Status Code **400**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Delete an existing todo

<a id="opIddeleteTodo"></a>

`DELETE /api/todo/{todoId}`

<h3 id="delete-an-existing-todo-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|todoId|path|string|true|todo id|

> Example responses

> 200 Response

```json
{
  "data": [
    "string"
  ],
  "message": "Delete success"
}
```

<h3 id="delete-an-existing-todo-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|success|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Bad request|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Not found|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="delete-an-existing-todo-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **400**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Share a specific todo with other accounts

<a id="opIdshareTodo"></a>

`PATCH /api/todo/{todoId}`

> Body parameter

```json
{
  "accounts": [
    "40992b3a-3cbd-4d99-80cd-cd351a32324f"
  ]
}
```

<h3 id="share-a-specific-todo-with-other-accounts-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|todoId|path|string|true|todo id|
|body|body|object|true|JSON with todo data|
|» accounts|body|[string]|false|none|

> Example responses

> 200 Response

```json
{
  "data": [
    null
  ],
  "message": "Update Success"
}
```

<h3 id="share-a-specific-todo-with-other-accounts-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|Updated|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Bad request|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|404|[Not Found](https://tools.ietf.org/html/rfc7231#section-6.5.4)|Inserted model not exists|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="share-a-specific-todo-with-other-accounts-responseschema">Response Schema</h3>

Status Code **200**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[any]|false|none|none|
|» message|string|false|none|none|

Status Code **400**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **404**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

## Create new todo

<a id="opIdcreateTodo"></a>

`POST /api/todo`

> Body parameter

```json
{
  "title": "Todo di prova",
  "description": "descrizione di prova",
  "note": "nessuna nota",
  "category": "importanti",
  "checked": true
}
```

<h3 id="create-new-todo-parameters">Parameters</h3>

|Name|In|Type|Required|Description|
|---|---|---|---|---|
|body|body|[TodoBodyReq](#schematodobodyreq)|true|JSON with todo data|

> Example responses

> 201 Response

```json
{
  "data": {
    "id": "45ca2e2c-91d1-482c-85bf-f0fc23022808"
  },
  "message": "Insert success"
}
```

<h3 id="create-new-todo-responses">Responses</h3>

|Status|Meaning|Description|Schema|
|---|---|---|---|
|201|[Created](https://tools.ietf.org/html/rfc7231#section-6.3.2)|Created|Inline|
|400|[Bad Request](https://tools.ietf.org/html/rfc7231#section-6.5.1)|Bad request|Inline|
|401|[Unauthorized](https://tools.ietf.org/html/rfc7235#section-3.1)|Not Authorized|Inline|
|403|[Forbidden](https://tools.ietf.org/html/rfc7231#section-6.5.3)|Forbitten|Inline|
|500|[Internal Server Error](https://tools.ietf.org/html/rfc7231#section-6.6.1)|Server Error|Inline|

<h3 id="create-new-todo-responseschema">Response Schema</h3>

Status Code **201**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|object|false|none|none|
|»» id|string|false|none|none|
|» message|string|false|none|none|

Status Code **400**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **401**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **403**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

Status Code **500**

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|» data|[string]|false|none|none|
|» message|string|false|none|none|

<aside class="warning">
To perform this operation, you must be authenticated by means of one of the following methods:
bearerAuth
</aside>

# Schemas

<h2 id="tocS_sortFilterParams">sortFilterParams</h2>
<!-- backwards compatibility -->
<a id="schemasortfilterparams"></a>
<a id="schema_sortFilterParams"></a>
<a id="tocSsortfilterparams"></a>
<a id="tocssortfilterparams"></a>

```json
{
  "limit": 0,
  "page": 0,
  "sortBy": "string",
  "sortValue": "string",
  "filterBy": "string",
  "filterValue": "string",
  "start": "string",
  "end": "string"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|limit|integer|false|none|none|
|page|integer|false|none|none|
|sortBy|string|false|none|none|
|sortValue|string|false|none|none|
|filterBy|string|false|none|none|
|filterValue|string|false|none|none|
|start|string|false|none|none|
|end|string|false|none|none|

<h2 id="tocS_AccountResponse">AccountResponse</h2>
<!-- backwards compatibility -->
<a id="schemaaccountresponse"></a>
<a id="schema_AccountResponse"></a>
<a id="tocSaccountresponse"></a>
<a id="tocsaccountresponse"></a>

```json
{
  "id": "59e7626e-49bf-4e63-b195-f4d826af8ad8",
  "username": "agent",
  "name": "Luca",
  "surname": "La Porta",
  "email": "agent@dev.com"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|string|false|none|none|
|username|string|false|none|none|
|name|string|false|none|none|
|surname|string|false|none|none|
|email|string|false|none|none|

<h2 id="tocS_AccountInfoResponse">AccountInfoResponse</h2>
<!-- backwards compatibility -->
<a id="schemaaccountinforesponse"></a>
<a id="schema_AccountInfoResponse"></a>
<a id="tocSaccountinforesponse"></a>
<a id="tocsaccountinforesponse"></a>

```json
{
  "name": "Luca",
  "surname": "La Porta"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|name|string|false|none|none|
|surname|string|false|none|none|

<h2 id="tocS_AccountsUsernames">AccountsUsernames</h2>
<!-- backwards compatibility -->
<a id="schemaaccountsusernames"></a>
<a id="schema_AccountsUsernames"></a>
<a id="tocSaccountsusernames"></a>
<a id="tocsaccountsusernames"></a>

```json
{
  "id": "a6ff9885-6166-4375-979a-bad6e2b4b9be",
  "username": "luca10"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|string|false|none|none|
|username|string|false|none|none|

<h2 id="tocS_AccountsResponse">AccountsResponse</h2>
<!-- backwards compatibility -->
<a id="schemaaccountsresponse"></a>
<a id="schema_AccountsResponse"></a>
<a id="tocSaccountsresponse"></a>
<a id="tocsaccountsresponse"></a>

```json
{
  "current_page": 1,
  "data": [
    {
      "id": "59e7626e-49bf-4e63-b195-f4d826af8ad8",
      "username": "agent",
      "name": "Luca",
      "surname": "La Porta",
      "email": "agent@dev.com"
    }
  ],
  "first_page_url": "http://localhost:8000/api/account/all?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://localhost:8000/api/account/all?page=1",
  "links": [
    {
      "url": "string",
      "label": "pagination.previous",
      "active": true
    }
  ],
  "next_page_url": "string",
  "path": "http://localhost:8000/api/account/all",
  "per_page": 10,
  "prev_page_url": "string",
  "to": 1,
  "total": 1
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|current_page|number|false|none|none|
|data|[[AccountResponse](#schemaaccountresponse)]|false|none|none|

<h2 id="tocS_AccountBodyReq">AccountBodyReq</h2>
<!-- backwards compatibility -->
<a id="schemaaccountbodyreq"></a>
<a id="schema_AccountBodyReq"></a>
<a id="tocSaccountbodyreq"></a>
<a id="tocsaccountbodyreq"></a>

```json
{
  "username": "john10",
  "name": "John",
  "surname": "Doe",
  "email": "johndow@email.com",
  "password": "abc1234"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|username|string|false|none|none|
|name|string|false|none|none|
|surname|string|false|none|none|
|email|string|false|none|none|
|password|string|false|none|none|

<h2 id="tocS_Auth">Auth</h2>
<!-- backwards compatibility -->
<a id="schemaauth"></a>
<a id="schema_Auth"></a>
<a id="tocSauth"></a>
<a id="tocsauth"></a>

```json
{
  "status": "success",
  "accountId": "8a2f56c2-5b5f-4b3f-996c-1774f33415cb",
  "authorization": {
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzIwNDI3NDE1LCJleHAiOjE3MjEwMzIyMTUsIm5iZiI6MTcyMDQyNzQxNSwianRpIjoiYXlGakZMcFBmaWlZRFV4YSIsInN1YiI6IjhhMmY1NmMyLTViNWYtNGIzZi05OTZjLTE3NzRmMzM0MTVjYiIsInBydiI6ImM4ZWUxZmM4OWU3NzVlYzRjNzM4NjY3ZTViZTE3YTU5MGI2ZDQwZmMiLCJyb2xlIjoiYmNiMDk1YWEtYmRlNi00NTVhLWE4NDEtNzYxMWM0M2FmY2VhIn0.r1SGjTg7GpiJjiN778yU2NKv39c8G4WmMKJAs9lW_5A",
    "type": "bearer"
  }
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|status|string|false|none|none|
|accountId|string|false|none|none|
|authorization|object|false|none|none|
|» token|string|false|none|none|
|» type|string|false|none|none|

<h2 id="tocS_Logged">Logged</h2>
<!-- backwards compatibility -->
<a id="schemalogged"></a>
<a id="schema_Logged"></a>
<a id="tocSlogged"></a>
<a id="tocslogged"></a>

```json
{
  "logged": true,
  "account": {
    "id": "59e7626e-49bf-4e63-b195-f4d826af8ad8",
    "username": "agent",
    "name": "Luca",
    "surname": "La Porta",
    "email": "agent@dev.com"
  }
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|logged|boolean|false|none|none|

<h2 id="tocS_CommentResponse">CommentResponse</h2>
<!-- backwards compatibility -->
<a id="schemacommentresponse"></a>
<a id="schema_CommentResponse"></a>
<a id="tocScommentresponse"></a>
<a id="tocscommentresponse"></a>

```json
{
  "id": "6ca498b0-3fb6-4094-ba16-42728383c587",
  "content": "Commento numero uno",
  "created_at": "2025-01-18 16:14:44",
  "updated_at": "2025-01-18 16:14:45",
  "todo_id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
  "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
  "account_username": "test"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|string|false|none|none|
|content|string|false|none|none|
|created_at|string|false|none|none|
|updated_at|string|false|none|none|
|todo_id|string|false|none|none|
|account_id|string|false|none|none|
|account_username|string|false|none|none|

<h2 id="tocS_CommentsResponse">CommentsResponse</h2>
<!-- backwards compatibility -->
<a id="schemacommentsresponse"></a>
<a id="schema_CommentsResponse"></a>
<a id="tocScommentsresponse"></a>
<a id="tocscommentsresponse"></a>

```json
{
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": "6ca498b0-3fb6-4094-ba16-42728383c587",
        "content": "Commento numero uno",
        "created_at": "2025-01-18 16:14:44",
        "updated_at": "2025-01-18 16:14:45",
        "todo_id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
        "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
        "account_username": "test"
      }
    ],
    "first_page_url": "http://host/request/all?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://host/request/all?page=1",
    "links": [
      {
        "url": "string",
        "label": "pagination.previous",
        "active": true
      }
    ],
    "next_page_url": "string",
    "path": "http://host/request/all",
    "per_page": 10,
    "prev_page_url": "string",
    "to": 1,
    "total": 1
  },
  "message": "string"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|data|object|false|none|none|
|» current_page|number|false|none|none|
|» data|[[CommentResponse](#schemacommentresponse)]|false|none|none|
|message|string|false|none|none|

<h2 id="tocS_CommentBodyReq">CommentBodyReq</h2>
<!-- backwards compatibility -->
<a id="schemacommentbodyreq"></a>
<a id="schema_CommentBodyReq"></a>
<a id="tocScommentbodyreq"></a>
<a id="tocscommentbodyreq"></a>

```json
{
  "content": "Commento di prova"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|content|string|false|none|none|

<h2 id="tocS_TodoResponse">TodoResponse</h2>
<!-- backwards compatibility -->
<a id="schematodoresponse"></a>
<a id="schema_TodoResponse"></a>
<a id="tocStodoresponse"></a>
<a id="tocstodoresponse"></a>

```json
{
  "id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
  "title": "Andare in palestra",
  "description": "Ricorda la cintura",
  "note": "string",
  "category": "hobby",
  "checked": true,
  "created_at": "2024-10-26 15:40:00",
  "updated_at": "2024-10-26 15:40:00",
  "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
  "sharedWith": [
    {
      "id": "2d414d58-79d9-4b90-897f-d29889e86b98",
      "username": "account_test"
    }
  ],
  "isShared": true,
  "comments": [
    {
      "id": "6ca498b0-3fb6-4094-ba16-42728383c587",
      "content": "Commento numero uno",
      "created_at": "2025-01-18 16:14:44",
      "updated_at": "2025-01-18 16:14:45",
      "todo_id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
      "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
      "account_username": "test"
    }
  ]
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|string|false|none|none|
|title|string|false|none|none|
|description|string|false|none|none|
|note|string|false|none|none|
|category|string|false|none|none|
|checked|boolean|false|none|none|
|created_at|string|false|none|none|
|updated_at|string|false|none|none|
|account_id|string|false|none|none|
|sharedWith|[object]|false|none|none|
|» id|string|false|none|none|
|» username|string|false|none|none|
|isShared|boolean|false|none|none|
|comments|[[CommentResponse](#schemacommentresponse)]|false|none|none|

<h2 id="tocS_TodoAccountsResponse">TodoAccountsResponse</h2>
<!-- backwards compatibility -->
<a id="schematodoaccountsresponse"></a>
<a id="schema_TodoAccountsResponse"></a>
<a id="tocStodoaccountsresponse"></a>
<a id="tocstodoaccountsresponse"></a>

```json
{
  "id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
  "username": "user_00"
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|id|string|false|none|none|
|username|string|false|none|none|

<h2 id="tocS_TodosResponse">TodosResponse</h2>
<!-- backwards compatibility -->
<a id="schematodosresponse"></a>
<a id="schema_TodosResponse"></a>
<a id="tocStodosresponse"></a>
<a id="tocstodosresponse"></a>

```json
{
  "current_page": 1,
  "data": [
    {
      "id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
      "title": "Andare in palestra",
      "description": "Ricorda la cintura",
      "note": "string",
      "category": "hobby",
      "checked": true,
      "created_at": "2024-10-26 15:40:00",
      "updated_at": "2024-10-26 15:40:00",
      "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
      "sharedWith": [
        {
          "id": "2d414d58-79d9-4b90-897f-d29889e86b98",
          "username": "account_test"
        }
      ],
      "isShared": true,
      "comments": [
        {
          "id": "6ca498b0-3fb6-4094-ba16-42728383c587",
          "content": "Commento numero uno",
          "created_at": "2025-01-18 16:14:44",
          "updated_at": "2025-01-18 16:14:45",
          "todo_id": "1dcc7661-1251-456a-873c-2aa2028de9fd",
          "account_id": "8a587029-80a2-4ae9-82e6-4f69f7383e63",
          "account_username": "test"
        }
      ]
    }
  ],
  "first_page_url": "http://localhost:8000/api/todo/all?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://localhost:8000/api/todo/all?page=1",
  "links": [
    {
      "url": "string",
      "label": "pagination.previous",
      "active": true
    }
  ],
  "next_page_url": "string",
  "path": "http://localhost:8000/api/todo/all",
  "per_page": 10,
  "prev_page_url": "string",
  "to": 1,
  "total": 1
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|current_page|number|false|none|none|
|data|[[TodoResponse](#schematodoresponse)]|false|none|none|

<h2 id="tocS_TodoBodyReq">TodoBodyReq</h2>
<!-- backwards compatibility -->
<a id="schematodobodyreq"></a>
<a id="schema_TodoBodyReq"></a>
<a id="tocStodobodyreq"></a>
<a id="tocstodobodyreq"></a>

```json
{
  "title": "Todo di prova",
  "description": "descrizione di prova",
  "note": "nessuna nota",
  "category": "importanti",
  "checked": true
}

```

### Properties

|Name|Type|Required|Restrictions|Description|
|---|---|---|---|---|
|title|string|false|none|none|
|description|string|false|none|none|
|note|string|false|none|none|
|category|string|false|none|none|
|checked|boolean|false|none|none|

