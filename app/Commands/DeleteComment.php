<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use App\Comment;
use App\Events\CommentDeleted;

class DeleteComment extends Command implements SelfHandling {

	protected $user, $comment, $commentable;
	
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, Comment $comment, $commentable)
	{
		$this->user = $user;
		$this->comment = $comment;
		$this->commentable = $commentable;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->comment->delete();
		event(new CommentDeleted($this->user, $this->comment, $this->commentable));
		return $comment;
	}

}
