
    <tr class="item-row">
        <td>
            <input type="text" class="form-control item" placeholder="Item" type="text" name="items_val[]" value="<?php echo html_escape($product->name) ?>">  
             <input type="hidden" class="form-control item" placeholder="Item" type="text" name="items[]" value="<?php echo html_escape($product->id) ?>">
        </td>
        <td>
            <input class="form-control" placeholder="Enter item description" type="text" name="details[]" value="<?php echo html_escape($product->details) ?>"> 
        </td>
        <td>
            <input class="form-control price invo" placeholder="Price" type="text" name="price[]" value="<?php echo html_escape($product->price) ?>"> 
        </td>
        <td>
            <input class="form-control qty" placeholder="Quantity" type="text" name="quantity[]" value="1">
        </td>
        <td width="15%">
            <div class="delete-btn">
                <span class="currency_wrapper"></span>
                <span class="total"><?php echo html_escape($product->price) ?></span>
                <a class="delete" href="javascript:;" title="Remove row">&times;</a>
                <input type="hidden" class="total" name="total_price[]" value="<?php echo html_escape($product->price) ?>">
                <input type="hidden" name="product_ids[]" value="<?php echo html_escape($product->id) ?>">
            </div>
        </td>
    </tr>
