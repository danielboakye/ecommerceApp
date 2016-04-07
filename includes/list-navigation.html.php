<style type="text/css">
	#message{display: none;}
</style>
<div class="pagination">
	<?php $i = 0; ?>
	<?php while($i < $total_pages)  : ?>

		<?php $i++; ?>

		<?php if($i <= 3) : ?>

			<?php if($i === $current_page) : ?>
				<span><?= htmlentities("{$i}"); ?></span> 
			<?php else : ?>
				<a href="./?pg=<?= urlencode($i); ?>"><?= htmlentities("{$i}"); ?></a>
			<?php endif; ?>

		<?php else : ?>
			<?php if($i == 4) : ?>
				<a id="mess" href="./?pg=<?= urlencode($i); ?>"><?= htmlentities("{$i}"); ?></a>
			<?php else : ?>	
				<a id="mess2" href="./?pg=<?= urlencode($i); ?>"><?= htmlentities("{$i}"); ?></a>
			<?php endif; ?>
		<?php endif; ?>

	<?php endwhile; ?>
	<button onclick="$('#mess').toggle();$('#mess2').toggle();">&gt;</button>	
</div>

<!-- IMPROVE ON THIS CODE -->
