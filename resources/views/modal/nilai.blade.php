<form action="{{ route('raport.nilaikurang') }}" method="post" enctype='multipart/form-data'>
    @csrf
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Nilai Kurang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" name="mapel" id="example-text-input">
                                <option selected disabled value>Pilih Mata Pelajaran</option>
                                <option value="n_hadits">AlQuran Hadits</option>
                                <option value="n_aqidah">Aqidah Akhlaq</option>
                                <option value="n_fiqih">Fiqih</option>
                                <option value="n_ski">Sejarah Kebudayaan Islam</option>
                                <option value="n_pkn">Pendidikan Kewarganegaraan</option>
                                <option value="n_bindo">Bahasa Indonesia</option>
                                <option value="n_barab">Bahasa Arab</option>
                                <option value="n_binggris">Bahasa Inggris</option>
                                <option value="n_matematika">Matematika</option>
                                <option value="n_ipa">Ilmu Pengetahuan Alam</option>
                                <option value="n_ips">Ilmu Pengetahuan Sosial</option>
                                <option value="n_sebud">Seni Budaya</option>
                                <option value="n_jasmani">Pendidikan Jasmani</option>
                                <option value="n_prakarya">Prakarya</option>
                                <option value="n_bjawa">Bahasa Jawa</option>
                                <option value="n_tik">Informatika</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-gradient-info btn-fw">Cek Nilai</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>