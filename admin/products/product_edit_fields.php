<div class="form-group">
    <label for="ProductName">Product Name:</label>
    <input type="text" name="ProductName" value="<?php echo htmlspecialchars($ProductName) ?>">
</div>

<div class="form-group">
    <label for="Description">Description:</label>
    <textarea id="Description" name="Description"><?php echo htmlspecialchars($Description) ?></textarea>
</div>

<div class="form-group">
    <label for="Stock">Stock:</label>
    <input type="number" name="Stock" value="<?php echo htmlspecialchars($Stock) ?>">
</div>

<div class="form-group">
    <label for="PriceEach">Price Each:</label>
    <input type="number" step="0.01" name="PriceEach" value="<?php echo htmlspecialchars($PriceEach) ?>">
</div>

<div class="form-group">
    <label for="ImagePath">Image Path:</label>
    <input type="text" name="ImagePath" value="<?php echo htmlspecialchars($ImagePath) ?>">
</div>

<div class="form-group">
    <label for="CategoryId">Category:</label>
    <select id="CategoryId" name="CategoryId">
        <?php foreach($categories as $category) { ?>
            <option value="<?php echo $category['CategoryId'] ?>" 
                <?php echo ($CategoryId === $category['CategoryId']) ? "selected='selected'" : ""; ?>><?php echo $category['CategoryName'] ?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label for="IsFeatured">Is Featured:</label>
    <input type="checkbox" class="chk" name="IsFeatured" value="1" <?php if ($IsFeatured == TRUE) echo "checked='checked'"; ?>>
</div>