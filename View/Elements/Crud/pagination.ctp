<?php
if ($this->Paginator->hasPage(null, 2)) {
	?>
	<div class="pagination">
		<ul>
			<?php
			echo $this->Paginator->prev('← Previous', array('tag' => 'li'), '<a href="#">← Previous</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
			echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => '', 'escape' => true, 'modulus' => 6, 'first' => 1, 'last' => 1));
			echo $this->Paginator->next('Next →', array('tag' => 'li'), '<a href="#">Next →</a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false ));
			?>
		</ul>
	</div>
	<?php
	echo $this->Paginator->counter(array('format' => 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'));
}

echo $this->Js->writeBuffer();