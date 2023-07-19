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
    {{-- @component('components.sidebar')
    @endcomponent --}}
    <main class="mt-14 ml-8">
        @yield('content')
    </main>
    <script>
        // 削除ボタンがクリックされたときの処理
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // デフォルトのフォーム送信をキャンセル
                // 確認ダイアログを表示し、OKボタンがクリックされた場合に削除処理を実行
                if (confirm('本当に削除しますか？')) {
                    this.submit(); // フォームを送信
                }
            });
        });
    </script>
</body>

</html>
