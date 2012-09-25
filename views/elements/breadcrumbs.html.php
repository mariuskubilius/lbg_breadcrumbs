<?php $current = array_pop($trail); ?>
<ul class="breadcrumb">
<?php foreach($trail as $crumb): ?>
	<li>
		<?= $this->html->link($crumb['title'], $crumb['url']);?>
		<span class="divider"><?= $separator; ?></span>
	</li>
<?php endforeach; ?>
<li class="active"><?= $current['title']; ?></li>
</ul>
