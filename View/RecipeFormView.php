<?php

include_once 'View.php';
include_once dirname(__FILE__) . '/../Model/Database/RecipeDAO.php';

class RecipeFormView extends View {

	function __construct($model) {
		parent::__construct($model);
	}

	public function initialize() {

	}

	public function printTitle() {
		if($this->model->add) {
			echo("Add Recipe");
		} else {
			echo("Edit Recipe");
		}

	}

	public function printBody() {
		global $loggedIn;
		global $admin;
		if($admin && $loggedIn) {
			if($this->model->add) {
				$this->add();
			} else {
				$this->edit();
			}

		} else {
			echo($this->model->error);
		}
	}

	public function printPageHeader() {
		if($this->model->add) {
			echo("Add Recipe");
		} else {
			echo("Edit Recipe");
		}
	}

	private function add() {
		$templateName = $this->model->template->getName();
		$templateId = $this->model->template->getIdRecipeTemplate();
		$itemName = $this->model->item->getName();
		$items = ItemDAO::selectAll();
		$itemId = $this->model->item->getIdItem();
		?>
		<h2><?php echo $itemName; ?></h2>
		<h3><?php echo $templateName; ?></h3>

		<div class="template">  <?php
		$imageName = $this->model->template->getImageName();
		echo("./pictures/templates/" . $imageName);
		$size = getimagesize("./pictures/templates/" . $imageName);
		$width = $size[0] * 2;
		$height = $size[1] * 2;
		$positions = $this->model->template->getPositions();
		$cords = explode(' | ', $positions);
		?>
		<div class="divImageTemplate">
			<img class="imageTemplate" src="./pictures/templates/<?php echo $imageName; ?>"
				 style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
			<?php
			foreach ($cords as $cord) {
				if($cord != '') {
					$xy = explode(' , ', $cord);
					$x = ($xy[0] - 14) * 2;
					$y = ($xy[1] - 14) * 2;
					?>
					<select form="addRecipe" name="recipeItems[]" class="recipeItemSelect"
							style="position: absolute; top:<?php echo $y; ?>px; left:<?php echo $x; ?>px; width: 50px; height: 50px;">
						<?php
						foreach ($items as $item) {
							$name = $item->getName();
							$id = $item->getIdItem();
							?>
							<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
						<?php
						}
						?>
					</select>
				<?php
				}
			}
			?>
		</div>


		<form id="addRecipe" name='addRecipe' method='post'
			  action='./index.php?page=recipe&item=<?php echo $itemId; ?>'>
			<input type='hidden' name='action' value='addRecipe'/>
			<input type='hidden' name='templateList' value='<?php echo $templateId; ?>'/>
			<input type='submit' name='save' value='save'/>
		</form>
	<?php
	}

	private function edit() {
		$templateName = $this->model->template->getName();
		$templateId = $this->model->template->getIdRecipeTemplate();
		$itemName = $this->model->item->getName();
		$allItems = ItemDAO::selectAll();
		$itemId = $this->model->item->getIdItem();
		$items = RecipeItemDAO::selectByRecipeId($this->model->recipeId);
		$recipe = RecipeDAO::selectById($this->model->recipeId);
		$outputItemId = (int)$recipe->getItemId();
		?>
		<h2><?php echo $itemName; ?></h2>
		<h3><?php echo $templateName; ?></h3>
		<div class="template">  <?php
		$imageName = $this->model->template->getImageName();
		echo("./pictures/templates/" . $imageName);
		$size = getimagesize("./pictures/templates/" . $imageName);
		$width = $size[0] * 2;
		$height = $size[1] * 2;
		$positions = $this->model->template->getPositions();
		$positions = explode(' | ', $positions);
		$length = count($positions) - 1;
		?>
		<div class="divImageTemplate">
			<img class="imageTemplate" src="./pictures/templates/<?php echo $imageName; ?>"
				 style="width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;">
			<?php
			foreach ($items as $item) {
				$position = $this->findPosition($positions, $item);
				$xy = explode(' , ', $position);
				$x = ($xy[0] - 14) * 2;
				$y = ($xy[1] - 14) * 2;
				$recipeItemId = (int)$item->getItemId();
				?>
				<select form="editRecipe" name="recipeItems[]" class="recipeItemSelect"
						style="position: absolute; top:<?php echo $y; ?>px; left:<?php echo $x; ?>px; width: 50px; height: 50px;">
					<?php
					foreach ($allItems as $allItem) {

						$name = $allItem->getName();
						$id = $allItem->getIdItem();
						if($recipeItemId == $id) {
							?>
							<option value="<?php echo $id; ?>" selected><?php echo $name; ?></option>
						<?php
						} else {
							?>
							<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
						<?php
						}
					}
					?>
				</select>
			<?php

			}
			$position = $positions[$length];
			$xy = explode(' , ', $position);
			$x = ($xy[0] - 14) * 2;
			$y = ($xy[1] - 14) * 2;
			?>
			<select form="editRecipe" name="recipeItems[]" class="recipeItemSelect"
					style="position: absolute; top:<?php echo $y; ?>px; left:<?php echo $x; ?>px; width: 50px; height: 50px;">
				<?php
				foreach ($allItems as $allItem) {

					$name = $allItem->getName();
					$id = $allItem->getIdItem();
					if($outputItemId == $id) {
						?>
						<option value="<?php echo $id; ?>" selected><?php echo $name; ?></option>
					<?php
					} else {
						?>
						<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
					<?php
					}
				}
				?>
			</select>
		</div>
		<form id="editRecipe" name='editRecipe' method='post'
			  action='./index.php?page=recipe&item=<?php echo $itemId; ?>'>
			<input type='hidden' name='action' value='editRecipe'/>
			<input type='hidden' name='id' value='<?php echo $this->model->recipeId; ?>'/>
			<input type='hidden' name='templateId' value='<?php echo $templateId; ?>'/>
			<input type='submit' name='save' value='save'/>
		</form>

	<?php
	}

	private function findPosition($positions, $recipeItem) {
		foreach ($positions as $position) {
			$itemPos = $recipeItem->getTablePos();
			if($itemPos == $position) {
				return $position;
			}
		}
		return NULL;
	}

}