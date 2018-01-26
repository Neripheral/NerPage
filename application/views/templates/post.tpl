<div class="p-2 w-100">
	<div id="post-{$id}" class="post container bg-dark text-light rounded p-3">
		<div class="postHeader w-100">
			<h4>{$title}</h4>
		</div>
		<hr class="border-light">
		<div class="postContent">
			<p>{$content}</p>
		</div>
		<hr class="border-light">
		<div class="postFooter">
			<div class="float-left">
				<button class="post-upvote-button {$upvote}"><span class="octicon octicon-thumbsup"></span></button>
				{$rating}
				<button class="post-downvote-button {$downvote}"><span class="octicon octicon-thumbsdown"></span></button>
			</div>
			<p class="text-secondary float-right m-0">Added by: {$username}</p>
		</div>
	</div>
</div>