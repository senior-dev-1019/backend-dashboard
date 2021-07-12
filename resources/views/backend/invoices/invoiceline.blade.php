<div id="{{ $id }}">
    <div class="form-group row">
        <input type="hidden" name="ids[]" value="{{ $id }}">
        <label for="invoiceline_amount" class="col-md-3 col-form-label text-md-right">@lang('dashboard.invoices.amount')</label>
    
        <div class="col-md-6">
            <input name="invoiceline_amounts[]" value="{{ old('invoiceline_amount') }}" type="number" step="any" class="form-control @error('invoiceline_amount') is-invalid @enderror" required autocomplete="invoiceline_amount" autofocus>
    
            @error('invoiceline_amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-3">
            <button type="button" onclick="removeInvoiceLine('{{ $id }}')" class="btn btn-danger" aria-label="Close">
                Delete
            </button>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="invoiceline_text" class="col-md-3 col-form-label text-md-right">@lang('dashboard.invoices.text')</label>
    
        <div class="col-md-6">
            <textarea name="invoiceline_texts[]" cols="30" rows="5" value="{{ old('invoiceline_text') }}" class="form-control @error('invoiceline_text') is-invalid @enderror" required autocomplete="invoiceline_text" autofocus></textarea>
    
            @error('invoiceline_text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <hr>
</div>
