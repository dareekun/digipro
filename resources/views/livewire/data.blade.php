<div>
<b>Rekap Produksi </b> @error('rekap.*') <span style="color:red"> - *{{ $message }}</span> @enderror
    <table style="width:100%">
        <tr>
            <td style="width:15%" align="center">Tipe Produk</td>
            <td style="width:100px" align="center">Start</td>
            <td style="width:100px" align="center">Stop</td>
            <td style="width:100px" align="center">Duration</td>
            <td style="width:100px" align="center">Daily Plan</td>
            <td style="width:100px" align="center">Daily Actual</td>
            <td style="width:100px" align="center">Daily (+/-)</td>
            <td style="width:100px" align="center">NG Process</td>
            <td style="width:100px" align="center">NG Material</td>
            <td style="width:20%" align="center">Ket</td>
            <td style="width:1%"></td>
        </tr>
        @foreach($data5 as $d5)
        <tr>
            <td><input disabled value="{{$d5->tipe}}" type="text" style="width:150px" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d5->start}}" type="time" style="width:100px" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d5->stop}}" type="time" style="width:100px"
                    class="form-control-plaintext" name="rekstop"></td>
            <td><input disabled value="{{$d5->dur}}" type="text" min="0" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d5->daily_plan}}" type="text" min="0" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d5->daily_actual}}" type="text" min="0" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d5->daily_diff}}" type="text" min="0" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d5->ng_process}}" type="text" min="0" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d5->ng_material}}" type="text" min="0" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d5->ket}}" type="text" min="0" class="form-control-plaintext"></td>
            <td align="left"><button class="btn btn-danger" type="submit" wire:click="delproduct('{{$d5->id}}')"><i
                        class="fa fa-minus-circle" aria-hidden="true"></i></button></button></td>
        </tr>
        @endforeach
        <tr>
            <td><div id="for-live-search5" wire:ignore><select wire:model.defer="rekap.produk" data-container="#for-live-search5" class="form-control selectpicker" data-live-search="true">
                    @foreach($produk as $p)
                    <option value="{{$p->tipe}}">{{$p->tipe}}</option>
                    @endforeach</div></td>
            <td><input wire:model.defer="rekap.start" type="time" class="form-control w-100"></td>
            <td><input wire:model.defer="rekap.stop" type="time" class="form-control w-100"></td>
            <td><input disabled type="number" min="0" class="form-control w-100"></td>
            <td><input wire:model.defer="rekap.plan" type="number" min="0" class="form-control w-100"></td>
            <td><input wire:model.defer="rekap.actual" type="number" min="0" class="form-control w-100"></td>
            <td><input disabled type="number" min="0" class="form-control w-100"></td>
            <td><input wire:model.defer="rekap.process" type="number" min="0" class="form-control w-100"></td>
            <td><input wire:model.defer="rekap.material" type="number" min="0" class="form-control w-100"></td>
            <td><input wire:model.defer="rekap.ket" type="text" class="form-control w-100"></td>
            <td align="left"><button class="btn btn-success" type="submit" wire:click="addproduct"><i
                        class="fa fa-plus-circle" aria-hidden="true"></i></button></td>
        </tr>
    </table>
    <br>
    <!-- loss 1 -->
    Regulated Loss @error('problem01.*') <span style="color:red"> - *{{ $message }}</span> @enderror
    <table>
        <tr>
            <td style="width:25%" align="center">Masalah Yang Terjadi</td>
            <td style="width:5%" align="center">Start</td>
            <td style="width:5%" align="center">Stop</td>
            <td style="width:5%" align="center">Durasi</td>
            <td style="width:15%" align="center">Produk yang dikerjakan</td>
            <td align="center">Keterangan</td>
            <td style="width:1%" ></td>
        </tr>
        @foreach($data1 as $d1)
        <tr>
            <td><input disabled value="{{$d1->problem}}" type="text" style="width:100px"
                    class="form-control-plaintext w-100"></td>
            <td><input disabled value="{{$d1->start}}" type="time" style="width:100px" class="form-control-plaintext w-100"></td>
            <td><input disabled value="{{$d1->stop}}" type="time" style="width:100px" class="form-control-plaintext w-100"></td>
            <td><input disabled value="{{$d1->dur}}" type="number" style="width:100px" class="form-control-plaintext w-100"></td>
            <td><input disabled value="{{$d1->tipe}}" type="text" class="form-control-plaintext w-100">
            <td><input disabled type="text" value="{{$d1->ket}}" class="form-control-plaintext w-100" name="regket"></td>
            <td align="right"><button class="btn btn-danger" type="submit" wire:click="delprob('{{$d1->idp}}')"><i
                        class="fa fa-minus-circle" aria-hidden="true"></i></button>
            </td>
        </tr>
        @endforeach
        <tr>
            <td><select wire:model.defer="problem01.masalah" class="custom-select">
                    <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                    @foreach($lossa as $a)
                    <option value="{{$a->loss}}">{{$a->loss}}</option>
                    @endforeach</td>
            <td><input type="time" data-placement="top" data-trigger="manual" data-content="Required"
                    wire:model.defer="problem01.start" style="width:100px" class="form-control"></td>
            <td><input type="time" data-placement="top" data-trigger="manual" data-content="Required"
                    wire:model.defer="problem01.finish" style="width:100px" class="form-control" name="regfinish0"></td>
            <td><input type="number" data-placement="top" data-trigger="manual" disabled style="width:100px"
                    class="form-control" name="regdur0"></td>
            <td><div id="for-live-search1" wire:ignore><select wire:model.defer="problem01.produk" data-container="#for-live-search1" class="form-control selectpicker" data-live-search="true">
                    @foreach($produk as $p)
                    <option value="{{$p->tipe}}">{{$p->tipe}}</option>
                    @endforeach</div></td>
            <td><input type="text" data-placement="top" data-trigger="manual" 
                    class="form-control" wire:model.defer="problem01.ket">
            </td>
            <td align="right"><button class="btn btn-success" type="submit" wire:click="plus01"><i
                        class="fa fa-plus-circle" aria-hidden="true"></i></button></td>
        </tr>
    </table>
    <br>
    <!-- loss 2 -->
    Work Loss @error('problem02.*') <span style="color:red"> - *{{ $message }}</span> @enderror
    <table>
        <tr>
            <td style="width:25%" align="center">Masalah Yang Terjadi</td>
            <td style="width:5%" align="center">Start</td>
            <td style="width:5%" align="center">Stop</td>
            <td style="width:5%" align="center">Durasi</td>
            <td style="width:15%" align="center">Produk yang dikerjakan</td>
            <td align="center">Keterangan</td>
            <td style="width:1%" ></td>
        </tr>
        @foreach($data2 as $d2)
        <tr>
            <td><input disabled value="{{$d2->problem}}" type="text" style="width:100px"
                    class="form-control-plaintext w-100" name="wrkprob"></td>
            <td><input disabled value="{{$d2->start}}" type="time" style="width:100px" class="form-control-plaintext w-100"></td>
            <td><input disabled value="{{$d2->stop}}" type="time" style="width:100px" class="form-control-plaintext w-100"></td>
            <td><input disabled value="{{$d2->dur}}" type="number" style="width:100px" class="form-control-plaintext w-100"></td>
            <td><input value="{{$d2->tipe}}" disabled type="text" class="form-control-plaintext w-100"></td>
            <td><input disabled type="text" value="{{$d2->ket}}" class="form-control-plaintext w-100" name="wrkket"></td>
            <td align="right"><button class="btn btn-danger" type="submit" wire:click="delprob('{{$d2->idp}}')"><i
                        class="fa fa-minus-circle" aria-hidden="true"></i></button></button></td>
        </tr>
        @endforeach
        <tr>
            <td><select wire:model.defer="problem02.masalah" class="custom-select">
                    <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                    @foreach($lossb as $b)
                    <option value="{{$b->loss}}">{{$b->loss}}</option>
                    @endforeach</td>
            <td><input wire:model.defer="problem02.start" type="time" style="width:100px" class="form-control"></td>
            <td><input wire:model.defer="problem02.finish" type="time" style="width:100px" class="form-control"></td>
            <td><input disabled type="number" style="width:100px" class="form-control"></td>
            <td><div id="for-live-search" wire:ignore><select wire:model.defer="problem02.produk" data-container="#for-live-search2" class="form-control selectpicker" data-live-search="true">
                    @foreach($produk as $p)
                    <option value="{{$p->tipe}}">{{$p->tipe}}</option>
                    @endforeach</div></td>
            <td><input type="text" class="form-control" wire:model.defer="problem02.ket">
            </td>
            <td align="right"><button class="btn btn-success" type="submit" wire:click="plus02"><i
                        class="fa fa-plus-circle" aria-hidden="true"></i></button></button></td>
        </tr>
    </table>
    <br>
    <!-- loss 3 -->
    Organization Loss @error('problem03.*') <span style="color:red"> - *{{ $message }}</span> @enderror
    <table>
        <tr>
            <td style="width:25%" align="center">Masalah Yang Terjadi</td>
            <td style="width:5%" align="center">Start</td>
            <td style="width:5%" align="center">Stop</td>
            <td style="width:5%" align="center">Durasi</td>
            <td style="width:15%" align="center">Produk yang dikerjakan</td>
            <td align="center">Keterangan</td>
            <td style="width:1%" ></td>
        </tr>
        @foreach($data3 as $d3)
        <tr>
            <td><input disabled value="{{$d3->problem}}" type="text" style="width:100px"
                    class="form-control-plaintext w-100" name="orprob"></td>
            <td><input disabled value="{{$d3->start}}" type="time" style="width:100px" class="form-control-plaintext w-100"></td>
            <td><input disabled value="{{$d3->stop}}" type="time" style="width:100px" class="form-control-plaintext w-100"></td>
            <td><input disabled value="{{$d3->dur}}" type="number" style="width:100px" class="form-control-plaintext w-100"></td>
            <td><input disabled value="{{$d3->tipe}}" type="text" class="form-control-plaintext w-100"></td>
            <td><input disabled value="{{$d3->ket}}" type="text" class="form-control-plaintext w-100"></td>
            <td align="right"><button class="btn btn-danger" type="submit" wire:click="delprob('{{$d3->idp}}')"><i
                        class="fa fa-minus-circle" aria-hidden="true"></i></button></button></td>
        </tr>
        @endforeach
        <tr>
            <td><select wire:model.defer="problem03.masalah" class="custom-select">
                    <option value="Tidak Ada Masalah" selected>Tidak Ada Masalah</option>
                    @foreach($lossc as $c)
                    <option value="{{$c->loss}}">{{$c->loss}}</option>
                    @endforeach</td>
            <td><input wire:model.defer="problem03.start" type="time" style="width:100px" class="form-control"></td>
            <td><input wire:model.defer="problem03.finish" type="time" style="width:100px" class="form-control"></td>
            <td><input disabled type="number" style="width:100px" class="form-control"></td>
            <td><div id="for-live-search3" wire:ignore><select wire:model.defer="problem03.produk" data-container="#for-live-search3" class="form-control selectpicker" data-live-search="true">
                    @foreach($produk as $p)
                    <option value="{{$p->tipe}}">{{$p->tipe}}</option>
                    @endforeach</div></td>
            <td><input type="text" value="-" class="form-control" wire:model.defer="problem03.ket">
            </td>
            <td align="right"><button class="btn btn-success" type="submit" wire:click="plus03"><i
                        class="fa fa-plus-circle" aria-hidden="true"></i></button></button></td>
        </tr>
    </table>
    <br>
    <!-- loss 4 -->
    Defect Loss @error('problem04.*') <span style="color:red"> - *{{ $message }}</span> @enderror
    <table>
        <tr>
            <td style="width:25%" align="center">Masalah Yang Terjadi</td>
            <td style="width:5%" align="center">Start</td>
            <td style="width:5%" align="center">Stop</td>
            <td style="width:5%" align="center">Durasi</td>
            <td style="width:15%" align="center">Produk yang dikerjakan</td>
            <td align="center">Keterangan</td>
            <td style="width:1%" ></td>
        </tr>
        @foreach($data4 as $d4)
        <tr>
            <td><input disabled value="{{$d4->problem}}" type="text" style="width:100px"
                    class="form-control-plaintext w-100" name="defprob"></td>
            <td><input disabled value="{{$d4->start}}" type="time" style="width:100px" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d4->stop}}" type="time" style="width:100px" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d4->dur}}" type="number" style="width:100px" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d4->tipe}}" type="text" class="form-control-plaintext"></td>
            <td><input disabled value="{{$d4->ket}}" type="text" class="form-control-plaintext"></td>
            <td align="right"><button class="btn btn-danger" type="submit" wire:click="delprob('{{$d4->idp}}')"><i
                        class="fa fa-minus-circle" aria-hidden="true"></i></button></button></td>
        </tr>
        @endforeach
        <tr>
            <td><select wire:model.defer="problem04.masalah" class="custom-select">
                    <option value="Tidak Ada Masalah" selected>Tidak Ada Masalah</option>
                    @foreach($lossd as $d)
                    <option value="{{$d->loss}}">{{$d->loss}}</option>
                    @endforeach</td>
            <td><input wire:model.defer="problem04.start" type="time" style="width:100px" class="form-control"></td>
            <td><input wire:model.defer="problem04.finish" type="time" style="width:100px" class="form-control"></td>
            <td><input disabled type="number" style="width:100px" class="form-control"></td>
            <td><div id="for-live-search4" wire:ignore><select wire:model.defer="problem04.produk" data-container="#for-live-search4" class="form-control selectpicker" data-live-search="true">
                    @foreach($produk as $p)
                    <option value="{{$p->tipe}}">{{$p->tipe}}</option>
                    @endforeach</div></td>
            <td><input type="text" wire:model.defer="problem04.ket" value="-" class="form-control"></td>
            <td align="right"><button class="btn btn-success" type="submit" wire:click="plus04"><i
                        class="fa fa-plus-circle" aria-hidden="true"></i></button></button></td>
        </tr>
    </table>
    <br>
    Result Produksi @error('result.*') <span style="color:red"> - *{{ $message }}</span> @enderror
    <table style="width:100%">
        <tr>
            <td style="width:20%" align="center">Hambatan</td>
            <td style="width:20%" align="center">Analisa Penyebab</td>
            <td style="width:20%" align="center">Tindakan Penanggulangan</td>
            <td style="width:10%" align="center">Hasil Produksi</td>
            <td style="width:12%" align="center">Available Working Time</td>
            <td style="width:10%" align="center">Production Head</td>
        </tr>
        <tr>
            <td><input wire:model.defer="result.hambatan01" type="text" class="form-control"></td>
            <td><input wire:model.defer="result.analisa01" type="text" class="form-control"></td>
            <td><input wire:model.defer="result.tindakan01" type="text" class="form-control"></td>
            <td>
                <div class="input-group"><input wire:model.defer="result.sum" type="number" class="form-control">
                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2">Pcs</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="input-group"><input wire:model.defer="result.avail" type="number" class="form-control" name="reslt5">
                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2">Menit</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="input-group"><input wire:model.defer="result.phh" type="number" class="form-control" name="reslt6">
                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2">Pcs/Jam</span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3"><br><br></td>
            <td>Total Loss Time</td>
            <td></td>
        </tr>
        <tr>
            <td><input wire:model.defer="result.hambatan02" type="text" class="form-control"></td>
            <td><input wire:model.defer="result.analisa02" type="text" class="form-control"></td>
            <td><input wire:model.defer="result.tindakan02" type="text" class="form-control"></td>
            <td>
                <div class="input-group"><input wire:model.defer="result.ttloss" type="number" min="0" class="form-control"
                        name="reslt4a">
                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2">Menit</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <br>
    <table style="width:100%">
        <tr>
            <td><button type="button" class="btn btn-danger" onclick="history.back();">Back</button>
            </td>
            <td align="right"><button type="submit" wire:click="process" class="btn btn-success">Next</button></td>
        </tr>
    </table>
</div>