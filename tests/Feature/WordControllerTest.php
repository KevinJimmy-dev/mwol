<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Language;
use App\Models\User;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;

# php artisan test --filter=WordControllerTest
class WordControllerTest extends TestCase
{
    # php artisan test --filter=WordControllerTest::test_index
    public function test_index()
    {
        $languages = Language::factory(1)->create();

        $user = User::factory(1)->create()->first();

        $words = Word::factory(10)->create(['user_id' => $user->id]);

        Auth::login($user);

        $this->assertAuthenticatedAs($user);
        $this->assertCount(1, $languages, "Era esperado 1 idioma!");
        $this->assertCount(10, $words, "Era esperado 10 palavras!");
    }

    # php artisan test --filter=WordControllerTest::test_store
    public function test_store()
    {
        Language::factory(1)->create();

        $user = User::factory(1)->create()->first();

        Word::factory(1)->create(['user_id' => $user->id])->first();

        Auth::login($user);

        $this->assertAuthenticatedAs($user);

        if (!is_null(Word::where('name', 'test')->where('user_id', $user->id)->first())) {
            $this->assertDatabaseHas('words', ['name' => 'test', 'user_id' => $user->id]);
        }

        $word = Word::factory(1)->create(['user_id' => $user->id, 'name' => 'test', 'translation' => 'teste'])->first();

        $this->assertEquals($word, $word, 'A palavra não corresponde!');
    }

    # php artisan test --filter=WordControllerTest::test_update
    public function test_update()
    {
        Language::factory(1)->create();

        $user = User::factory(1)->create()->first();

        $word = Word::factory(1)->create(['user_id' => $user->id])->first();

        Auth::login($user);

        $this->assertAuthenticatedAs($user);

        if (!is_null(Word::where('name', 'teste')->where('user_id', $user->id)->first())) {
            $this->assertDatabaseHas('words', ['name' => 'teste', 'user_id' => $user->id]);
        }

        $word->update([
            'name' => 'test',
            'translation' => 'teste'
        ]);

        $this->assertEquals($word, $word, 'A palavra não corresponde!');
    }

    # php artisan test --filter=WordControllerTest::test_delete
    public function test_delete()
    {
        Language::factory(1)->create();

        $user = User::factory(1)->create()->first();

        $word = Word::factory(1)->create(['user_id' => $user->id])->first();

        Auth::login($user);

        $this->assertAuthenticatedAs($user);

        $this->assertDatabaseHas('words', ['name' => $word->name, 'user_id' => $user->id]);

        $word->phrases()->delete();

        $word->delete();

        $this->assertDatabaseMissing('words', ['name' => $word->name, 'user_id' => $user->id]);
    }
}
