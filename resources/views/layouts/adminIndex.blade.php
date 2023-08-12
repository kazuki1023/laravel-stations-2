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
    @component('components.adminsidebar')
    @endcomponent
    <main class="mt-14 ml-64 pt-14">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.1.0/dist/js/coreui.bundle.min.js"></script>
    <script>
        // 削除ボタンがクリックされたときの処理
        document.addEventListener("DOMContentLoaded", function() {
            // 削除ボタンがクリックされたときの処理
            document.querySelectorAll('.delete-form').forEach(form => {
                console.log("発火");
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // デフォルトのフォーム送信をキャンセル
                    // 確認ダイアログを表示し、OKボタンがクリックされた場合に削除処理を実行
                    if (confirm('本当に削除しますか？')) {
                        this.submit(); // フォームを送信
                    }
                });
            });
        });
    </script>
</body>

</html>
