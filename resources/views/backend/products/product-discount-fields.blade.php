<div class="row">
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="discount_type" class="form-label">Discount Type
            </label>
            <select name="discount_type" id="discount_type" class="form-select select2" required>
                <option value="" selected>Select Discount Type</option>
                <option value="fixed">Fixed</option>
                <option value="percent">Percent %</option>
            </select>
            <div class="invalid-feedback">
                Please select discount type
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-3">
        <div class="form-group">
            <label for="discount_amount" class="control-label">Discount ( % |
                $)</label>
            <input type="text" class="form-control input-mask text-start" name="discount_amount" id="discount_amount"
                value="{{ old('discount_amount') }}" placeholder="Discount % | $"
                data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" required/>
            <div class="invalid-feedback">
                Please enter valid discount amount
            </div>
        </div>
    </div>
</div>
