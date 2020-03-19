# 簡易登入與註冊

-   WEB
    -   登入
        -   路由:login
        -   敘述: 使用者輸入帳號密碼
    -   註冊
        -   路由:register
        -   敘述: 使用者新增帳號資訊
-   API
    -   登入
        -   路由:api/login
        -   敘述: 驗證使用者輸入帳號密碼
    -   註冊
        -   路由:api/register
        -   敘述:註冊使用者新增帳號資訊

# 網路爬蟲並將十二星座資訊

-   API
    -   登入
        -   路由:api/reptile
        -   敘述: 爬取星座資訊，並存入
```
路由配置
API
    Route::get('reptile', 'Api\Reptile@index')->name("Reptile.index");
    Route::post('login', 'UserController@login')->name("UserController.login");
    Route::post('register', 'UserController@registered')->name("UserController.registered");
WEB
    Route::get('login', 'UserController@index')->name("UserController.index");
    Route::get('register', 'UserController@register')->name("UserController.register");

網址 :
    ngrok/login
    ngrok/register
    ngrok/api/reptile	
```
