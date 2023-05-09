{{-- 管理者画面の雛形 --}}
<!DOCTYPE html>
<html lang="ja">
<head>
  @component('components.link')
  @endcomponent
  <title>管理者画面</title>
</head>
<body>
  @component('components.header')
  @endcomponent
  @component('components.sidebar')
  @endcomponent
  <main>
    @yield('content')
  </main>
</body>
</html>