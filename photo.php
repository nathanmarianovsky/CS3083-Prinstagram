<?php

include "config.php";

class Photo {
	public $pid;
	public $poster;
	public $caption;
	public $pdate;

	public function populate($_pid, $_poster, $_caption, $_pdate) {
		$this->pid = $_pid;
		$this->poster = $_poster;
		$this->caption = $_caption;
		$this->pdate = $_pdate;
	}
	
	function render() {
	?>
	<div class="entry"> 
		<img class="photo_image" src="getImage.php?pid=<?=$this->pid?>" />
		<div class="photo_info">
			<?php 
				if($this->caption != NULL) {
					?>
					<span class="photo_caption">
						<?=$this->caption?>
					</span>
					<?php
				} 
			?>
			<span class="photo_poster">
				<?=$this->poster?>
			</span>
			<span class="photo_pdate">
				<?=$this->pdate?>
			</span>
			<a class="photo_comments" href="show_comments.php?pid=<?=$this->pid?>">Comments</a>
			<a class="list_tagged" href="list_tagged.php?pid=<?=$this->pid?>">Tags</a>
			<br>
			<a class="photo_comments" href="add_comment.php?pid=<?=$this->pid?>">Add Comment</a>
			<a class="tag" href="tag_user.php?pid=<?=$this->pid?>">Tag a User</a>
		</div>
	</div>
	<?php
	}

	function tag_render() {
	?>
	<div class="entry"> 
		<img class="photo_image" src="getImage.php?pid=<?=$this->pid?>" />
		<div class="photo_info">
			<?php 
				if($this->caption != NULL) {
					?>
					<span class="photo_caption">
						<?=$this->caption?>
					</span>
					<?php
				} 
			?>
			<span class="photo_poster">
				Tagger: <?=$this->poster?>
			</span>
			<span class="photo_pdate">
				<?=$this->pdate?>
			</span>
			<a class="photo_comments" href="show_comments.php?pid=<?=$this->pid?>">Comments</a>
			<a class="list_tagged" href="list_tagged.php?pid=<?=$this->pid?>">Tags</a>
			<br>
			<a class="photo_comments" href="add_comment.php?pid=<?=$this->pid?>">Add Comment</a>
			<a class="tag" href="tag_user.php?pid=<?=$this->pid?>">Tag a User</a>
		</div>
	</div>
	<?php
	}
}

?>