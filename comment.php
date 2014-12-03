<?php

class Comment {
	private $ctime;
	private $ctext;
	private $cid;
	private $username;

	public function populate($_cid, $_ctime, $_ctext, $_username) {
		$this->cid = $_cid;
		$this->ctime = $_ctime;
		$this->ctext = $_ctext;
		$this->username = $_username;
	}

	public function render() {
		?>
		<div class="comment">
			<span class="comment_text">
				<?=$this->ctext?>
			</span>
			<div class="comment_info">
				<?=$this->username?> wrote on <?=$this->ctime?>
			</div>
		</div>
		<?php
	}
}

?>