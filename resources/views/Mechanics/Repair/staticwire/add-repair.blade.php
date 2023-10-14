<div>
    <form class="row g-3" autocomplete="off" method="post">
        @csrf
        <div class="col-md-6">
            <label for="inputLastName1" class="form-label">Logged By</label>
            <div class="input-group">
                <select name="mechanic" id="mechanic" class="form-control">
                    <option disabled>-- Please Select  --</option>
                    @foreach($mechanics as $mechanic)
                        <option value="{{$mechanic->id}}" {{Auth::id() == $mechanic->id ? 'selected' : ''}}>{{$mechanic->name}}</option>
                    @endforeach
                </select>
                <div>@error('input_mechanic') {{ $message }} @enderror</div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="input_customer" class="form-label">Customer Name</label>
            <div class="input">
                <input type="text" class="form-control" id="customer" placeholder="John Doe" name="customer" value="Unknown"/>
            </div>
        </div>
        <div class="col-12">
            <label for="input_vehicle" class="form-label">Vehicle</label>
            <div class="input">
                <select name="select_vehicle" id="select_vehicle" class="form-control" style="width: 100% !important;" >
                    <option value="No Vehicle Specified">Unknown / No Vehicle</option>
                    <optgroup label="Generic Types">
                        <option value="Boat">Boat</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Compact">Compact</option>
                        <option value="Coupe">Coupe</option>
                        <option value="Cycle">Cycle</option>
                        <option value="Helicopter">Helicopter</option>
                        <option value="Industrial">Industrial</option>
                        <option value="Military">Military</option>
                        <option value="Motorcycle">Motorcycle</option>
                        <option value="Muscle Car">Muscle Car</option>
                        <option value="Off-Road">Off-Road</option>
                        <option value="Plane">Plane</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Service">Service</option>
                        <option value="Sports Car">Sports Car</option>
                        <option value="Sports Classic">Sports Classic</option>
                        <option value="Special">Special</option>
                        <option value="Super Car">Super Car</option>
                        <option value="SUV">SUV</option>
                        <option value="Utility">Utility</option>
                        <option value="Van">Van</option>
                    </optgroup>
                    <optgroup label="PDM">
                        @foreach($vehicles->data->pdm as $pdm)
                            <option value="{{$pdm->label}}">{{$pdm->label}}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="EDM">
                        @foreach($vehicles->data->edm as $edm)
                            <option value="{{$edm->label}}">{{$edm->label}}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Addon">
                        @foreach($vehicles->data->addon as $ao)
                            <option value="{{$ao->label == '' ? $ao->modelName : $ao->label }}">{{$ao->label == '' ? $ao->modelName : $ao->label }}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Work Vehicles">
                        <option value="Phantom">Phantom</option>
                        <option value="Taxi">Taxi</option>
                        <option value="EMS Vehicle">EMS Vehicle</option>
                        <option value="PD Vehicle">PD Vehicle</option>
                        <option value="Aircraft">Aircraft</option>
                        <option value="Boat">Boat</option>
                    </optgroup>
                </select>
            </div>
        </div>
        <div id="scrapDiv" class="col-2">
            <label for="scrapCost" class="form-label">Scrap</label>
            <div class="input">
                <input type="number" min="0" class="form-control" id="scrap" name="scrap" onchange="multiply(this.value,{!! Config('app.scrap-sell') !!},'scrapCost')" value="0" wire:model="input_scrap" required/>
                <input type="hidden" class="form-control" id="scrapCost" value="0" required="required" onchange="finalValue()" onClick="this.setSelectionRange(0, this.value.length)" />
                <div>@error('input_scrap') {{ $message }} @enderror</div>
            </div>
        </div>
        <div id="alumDiv" class="col-2">
            <label for="aluminium" class="form-label">Alum</label>
            <div class="input">
                <input type="number" min="0" class="form-control" id="aluminium" name="aluminium" value="0" onchange="multiply(this.value,{!! Config('app.aluminium-sell') !!},'alumCost')" wire:model="input_aluminium" required/>
                <input type="hidden" class="form-control" id="alumCost" value="0" required="required" onchange="finalValue()" />
            </div>
        </div>
        <div id="steelDiv" class="col-2">
            <label for="inputConfirmPassword" class="form-label">Steel</label>
            <div class="input">
                <input type="number" min="0" class="form-control" id="steel" name="steel" value="0" onchange="multiply(this.value,{!! Config('app.steel-sell') !!},'steelCost')" wire:model="input_steel" required/>
                <input type="hidden" class="form-control" id="steelCost" value="0" required="required" onchange="finalValue()" />
            </div>
        </div>
        <div id="glassDiv" class="col-2">
            <label for="inputConfirmPassword" class="form-label">Glass</label>
            <div class="input">
                <input type="number" min="0" class="form-control" id="glass" name="glass" value="0" onchange="multiply(this.value,{!! Config('app.glass-sell') !!},'glassCost')" wire:model="input_glass" required/>
                <input type="hidden" class="form-control" id="glassCost" value="0" required="required" onchange="finalValue()" />
            </div>
        </div>
        <div id="rubberDiv" class="col-2">
            <label for="inputConfirmPassword" class="form-label">Rubber</label>
            <div class="input">
                <input type="number" min="0" class="form-control" id="rubber" name="rubber" value="0" onchange="multiply(this.value,{!! Config('app.rubber-sell') !!},'rubberCost')" wire:model="input_rubber" required/>
                <input type="hidden" class="form-control" id="rubberCost" value="0" required="required" onchange="finalValue()" />
            </div>
        </div>
        <div class="col-2">

        </div>

        <div id="repairKitDiv" class="col-3">
            <label for="inputConfirmPassword" class="form-label">Adv. Repair Kit</label>
            <div class="input">
                <input type="number" min="0" class="form-control" id="advKit" name="advKit" value="0" onchange="multiply(this.value,{!! Config('app.adv-repair-kit-sell') !!},'advKitCost')" wire:model="input_advKit" required/>
                <input type="hidden" class="form-control" id="advKitCost" value="0" required="required" onchange="finalValue()" />
            </div>
        </div>
        <div id="oilDiv" class="col-2">
            <label for="inputConfirmPassword" class="form-label">Motor Oil</label>
            <div class="input">
                <input type="number" min="0" class="form-control" id="oil" name="oil" value="0" onchange="multiply(this.value,{!! Config('app.oil-sell') ?? 600 !!},'oilCost')" wire:model="input_oil" required/>
                <input type="hidden" class="form-control" id="oilCost" value="0" required="required" onchange="finalValue()" />
            </div>
        </div>
        <div class="col-2"></div>
        <div class="col-2"></div>
        <div class="col-3"></div>

        <div id="totalDiv" class="col-3">
            <label for="inputAddress3" class="form-label">Total ($)</label>
            <div class="input-group">
                <input  type="number" class="form-control" id="fullCost" name="FinalCost" value="0" wire:model="input_finalCost" readonly/>
            </div>
        </div>
        <div id="10Div" class="col-2">
            <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">10% Off</span></label>
            <div class="input-group">
                <input  type="currency" class="form-control" id="10Cost" name="10Cost" value="0" readonly/>
            </div>
        </div>
        <div id="15Div" class="col-2">
            <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">15% Off</span></label>
            <div class="input-group">
                <input  type="currency" class="form-control" id="15Cost" name="15Cost" value="0" readonly/>
            </div>
        </div>
        <div id="20Div" class="col-2">
            <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">20% Off</span></label>
            <div class="input-group">
                <input  type="currency" class="form-control" id="20Cost" name="20Cost" value="0" readonly/>
            </div>
        </div>
        <div id="25Div" class="col-2">
            <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">25% Off</span></label>
            <div class="input-group">
                <input  type="currency" class="form-control" id="25Cost" name="25Cost" value="0" readonly/>
            </div>
        </div>
        <div class="col-12">
            <hr/>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" required>
                <label class="form-check-label" for="flexSwitchCheckDefault">Ready to submit</label>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-danger px-5">Log Repair</button>
        </div>
    </form>
</div>

@push('scripts')
    <!-- Listen -->

@endpush
