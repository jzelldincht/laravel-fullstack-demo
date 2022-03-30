<?php

return [
    'name' => 'Api',
    // 访问接口时apiKey相应的Header的Name值
    'apiKeyHeaderName' => 'X-Api-Key',
    // 访问接口时提供的apiKey，必须项
    'apiKey' => 'HelloWorld',
    // 不用token即可访问的路由
    'routesWithoutToken' => [
        'api/v1/auth/login',// 登录页面
    ],
];
