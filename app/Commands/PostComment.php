<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Comment;
use App\Events\CommentPosted;

class PostComment extends Command implements SelfHandling {

	protected $user, $data, $commentable;
	
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, array $data, $commentable)
	{
		$this->user = $user;
		$this->data = $data;
		$this->commentable = $commentable;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$comment = Comment::create($this->data);
		$comment->owner()->associate($this->user); // belongsTo
		//~ $comment->commentable()->save($this->commentable); // morphTo : error
		$comment->commentable()->associate($this->commentable);
		event(new CommentPosted($this->user, $comment, $this->commentable));
		return $comment;
	}

}
