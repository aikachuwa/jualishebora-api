<?php

use Faker\Factory as Faker;
use App\Models\Post;
use App\Repositories\PostRepository;

trait MakePostTrait
{
    /**
     * Create fake instance of Post and save it in database
     *
     * @param array $postFields
     * @return Post
     */
    public function makePost($postFields = [])
    {
        /** @var PostRepository $postRepo */
        $postRepo = App::make(PostRepository::class);
        $theme = $this->fakePostData($postFields);
        return $postRepo->create($theme);
    }

    /**
     * Get fake instance of Post
     *
     * @param array $postFields
     * @return Post
     */
    public function fakePost($postFields = [])
    {
        return new Post($this->fakePostData($postFields));
    }

    /**
     * Get fake data of Post
     *
     * @param array $postFields
     * @return array
     */
    public function fakePostData($postFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'body' => $fake->text,
            'topic_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $postFields);
    }
}
