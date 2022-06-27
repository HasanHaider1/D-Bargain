<div  class="panel product-tab">
    <h3>{l s='Bargain Information'}</h3>
<div class="form-group">
    <div class="col-lg-1"></div>
    <label class="control-label col-lg-2" for="minimumprice">
        <span class="label-tooltip" data-toggle="tooltip" title="{l s='The minimum price of a product'}">{if !$country_display_tax_label || $tax_exclude_taxe_option}{l s='Minimum price'}{else}{l s='Pre-tax minimum price'}{/if}</span>
    </label>
    <div class="col-lg-2">
        <div class="input-group">
            <span class="input-group-addon">{$currency->prefix}{$currency->suffix}</span>
            <input maxlength="27" name="minimumprice" id="minimumprice" type="text" value="{{$product->minimumprice}}" onchange="this.value = this.value.replace(/,/g, '.');" />
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-lg-1"></div>
    <label class="control-label col-lg-2" for="startdate">
        <span class="label-tooltip" data-toggle="tooltip" title="{l s='Start date of bargain'}">Start Date</span>
    </label>
    <div class="col-lg-2">
        <div class="input-group">
            <input maxlength="27" name="startdate" id="startdate" type="date" value="{{$product->startdate}}" onchange="this.value = this.value.replace(/,/g, '.');" />
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-lg-1"></div>
    <label class="control-label col-lg-2" for="enddate">
        <span class="label-tooltip" data-toggle="tooltip" title="{l s='End date of bargain'}">End Date</span>
    </label>
    <div class="col-lg-2">
        <div class="input-group">
            <input maxlength="27" name="enddate" id="enddate" type="date" value="{{$product->enddate}}" onchange="this.value = this.value.replace(/,/g, '.');" />
        </div>
    </div>
</div>
</div>
