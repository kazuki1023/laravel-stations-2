<?php

namespace Tests\Feature\LaravelStations\Station11;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group station11
 */
class MovieTest extends TestCase
{
    // テストケースごとにDBをリフレッシュする
    use RefreshDatabase;

    public function test映画一覧に全ての映画のタイトル、画像URLが表示されているか(): void
    {
        $count = 12;
        for ($i = 0; $i < $count; $i++) {
            Movie::insert([
                'title' => 'タイトル'.$i,
                'image_url' => 'https://techbowl.co.jp/_nuxt/img/6074f79.png',
                'published_year' => 2000 + $i,
                'description' => '概要'.$i,
                'is_showing' => (bool)random_int(0, 1),
            ]);
        }
        $movies = Movie::all();
        $response = $this->get('/movies');
        $response->assertStatus(200);
        foreach ($movies as $movie) {
            $response->assertSeeText($movie->title);
            $response->assertSee($movie->image_url);
        }
    }

    // is_showing=1 が渡されているときは公開中のみ、 is_showing=0 が渡されているときは公開予定のみを表示する
    public function test映画一覧で検索ができるか(): void
    {
        $count = 12;
        for ($i = 0; $i < $count; $i++) {
            Movie::insert([
                'title' => 'タイトル'.$i,
                'image_url' => 'https://techbowl.co.jp/_nuxt/img/6074f79.png',
                'published_year' => 2000 + $i,
                'description' => '概要概要概要'.$i,
                'is_showing' => 1,
            ]);
        }
        // // タイトル
        $response = $this->get('/movies?keyword=トル5');
        $response->assertStatus(200);
        $response->assertSeeText('タイトル5');

        $movies = Movie::where('title', '<>', 'タイトル5')->get();
        foreach ($movies as $movie) {
            $response->assertDontSee($movie->title);
        }

        // 概要
        $response = $this->get('/movies?keyword=概要9');
        $response->assertStatus(200);
        $response->assertSeeText('タイトル9');

        $movies = Movie::where('title', '<>', 'タイトル9')->get();
        foreach ($movies as $movie) {
            $response->assertDontSee($movie->title);
        }

        // 上映中かどうか
        $response = $this->get('/movies?is_showing=1');
        foreach ($movies as $movie) {
            $response->assertSee($movie->title);
        }
        $response = $this->get('/movies?is_showing=0');
        $movies = Movie::all();
        foreach ($movies as $movie) {
            $response->assertDontSee($movie->title);
        }

        // 組み合わせ
        Movie::insert([
            'title' => 'タイトル-1',
            'image_url' => 'https://techbowl.co.jp/_nuxt/img/6074f79.png',
            'published_year' => 2000,
            'description' => '概要概要概要-1',
            'is_showing' => 0,
        ]);
        Movie::insert([
            'title' => 'タイトル-2',
            'image_url' => 'https://techbowl.co.jp/_nuxt/img/6074f79.png',
            'published_year' => 2000,
            'description' => '概要概要概要-2',
            'is_showing' => 0,
        ]);
        $response = $this->get('/movies?is_showing=0&keyword=-2');
        $response->assertSee('タイトル-2');
        $movies = Movie::where('title', '<>', 'タイトル-2')->get();
        foreach ($movies as $movie) {
            $response->assertDontSee($movie->title);
        }
    }

    /**
     * @dataProvider dataProvider_ページに対応する映画タイトル
     */
    public function test_1ページあたり20件ずつのページネーションが動いている(
        int $page,
        array $includes,
        array $excludes,
    ): void
    {
        foreach (range(0, 20) as $value) {
            Movie::insert([
                'title' => 'タイトル' . $value,
                'image_url' => 'https://techbowl.co.jp/_nuxt/img/6074f79.png',
                'published_year' => 2000,
                'description' => '概要',
                'is_showing' => true,
            ]);
        }

        $response = $this->get('/movies?page=' . $page);
        $response->assertSeeTextInOrder($includes);
        $response->assertDontSee($excludes);
    }

    public function dataProvider_ページに対応する映画タイトル(): array
    {
        return [
            '1ページ目(20件表示)指定時' =>[
                'page' => 1,
                'includes' => ['タイトル0', 'タイトル19'],
                'excludes' => ['タイトル20'],
            ],
            '2ページ目(1件表示)指定時' => [
                'page' => 2,
                'includes' => ['タイトル20'],
                'excludes' => ['タイトル19'],
            ],
            '存在しないページ指定時' =>[
                'page' => 0,
                'includes' => ['タイトル0', 'タイトル19'],
                'excludes' => ['タイトル20'],
            ],
        ];
    }
}
