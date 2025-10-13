<!-- 共通部分 -->
<!DOCTYPE html>
<html lang="ja">


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/edit-item.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/select-season.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/page-button.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/item-list.css') }}" />
    @yield('css')
</head>


<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                mogitate
            </a>
        </div>
    </header>


    <main>
        <div class="main-form">
            @yield('content')
        </div>
    </main>
</body>


</html>