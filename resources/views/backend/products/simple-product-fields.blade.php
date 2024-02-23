<div class="col-lg-3 mb-3">
    <div class="form-group">
        <label for="price" class="control-label">Price</label>
        <input type="text" class="form-control input-mask text-start" name="price" id="price"
            value="{{ old('price') }}" placeholder="Price"
            data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" required/>
        <div class="invalid-feedback">
            Please enter valid price
        </div>
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity </label>
        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity"
            value="{{ old('quantity') }}" min="0" required />
        <div class="invalid-feedback">
            Please enter Quantity.
        </div>
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3">
        <label for="stock_alert_quantity" class="form-label">Stock Alert
            Quantity</label>
        <input type="number" class="form-control" name="stock_alert_quantity" id="stock_alert_quantity"
            placeholder="Stock Alert Quantity" value="{{ old('stock_alert_quantity') }}" min="0" required />
        <div class="invalid-feedback">
            Please enter Stock Alert Quantity.
        </div>
    </div>
</div>
<div class="col-lg-3">
    <div class="mb-3">
        <label for="sku" class="form-label">SKU </label>
        <input type="text" class="form-control" name="sku" id="sku" placeholder="product sku"
            value="{{ old('sku') }}" required />
        <div class="invalid-feedback">
            Please enter product sku.
        </div>
    </div>
</div>

<div class="col-lg-12 product-discount">
    
</div>
