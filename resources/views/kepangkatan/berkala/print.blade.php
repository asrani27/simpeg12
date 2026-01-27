<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 2</title>
<style type="text/css">
.auto-style2 {
	text-align: center;
}
.auto-style3 {
	font-size: x-large;
}
.auto-style5 {
	text-decoration: underline;	
    font-size: small;
}
.auto-style6 {
	font-size: small;
}

.auto-style7 {
	font-size: large;
}
.auto-style8 {
	font-size: medium;
}

</style>
</head>

<body>

<table style="width: 100%">
	<tr>
		<td class="auto-style2"><img height="70" src="/theme/logo.jpg" width="51" style="float: right" />&nbsp;</td>
		<td class="auto-style2"><span class="auto-style3"><strong>PEMERINTAH 
		KOTA BANJARMASIN</strong></span><strong><br class="auto-style3" />
		</strong><span class="auto-style8"><strong>BADAN KEPEGAWAIAN DAERAH PENDIDIKAN DAN PELATIHAN</strong></span><br />
		<span class="auto-style6">Jalan RE. Martadinata No.1 Telp (0511) 3363790 Fax. (0511) 3363317 Kota Pos 79 Banjarmasin</span></td>
		<td>&nbsp;</td>
	</tr>
</table>
<hr />
<table style="width: 100%">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td style="width: 404px">&nbsp;</td>
		<td>Banjarmasin, {{\Carbon\Carbon::parse($data->tanggal_sk)->translatedFormat('d F Y')}}</td>
	</tr>
	<tr>
		<td>Nomor</td>
		<td>:</td>
		<td style="width: 404px">{{$data->nomor}}</td>
		<td>Kepada Yth.</td>
	</tr>
	<tr>
		<td>Lampiran</td>
		<td>:</td>
		<td style="width: 404px">{{$data->lampiran}}</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td valign="top">Perihal</td>
		<td valign="top">:</td>
		<td valign="top" style="width: 404px">Kenaikan Gaji Berkala a.n<br />
		{{$data->nama}} /<br />
		NIP. {{konversi_nip($data->nip)}}</td>
		<td>Walikota Banjarmasin<br />
		Up. Kepala Badan Keuangan<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Daerah Kota Banjarmasin<br />
		di&nbsp;&nbsp; -<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Banjarmasin</td>
	</tr>
	<tr>
		<td valign="top">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" style="width: 404px">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td valign="top">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" colspan="2">Bersama ini diberitahukan, bahwa berhubung 
		dengan telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada :<table style="width: 100%">
			<tr>
				<td>1.</td>
				<td>Nama dan Tanggal Lahir</td>
				<td>:</td>
				<td><strong>{{$data->nama}} / {{\Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y')}}</strong></td>
			</tr>
			<tr>
				<td>2.</td>
				<td>NIP</td>
				<td>:</td>
				<td>{{konversi_nip($data->nip)}}</td>
			</tr>
			<tr>
				<td>3.</td>
				<td>Pangkat / Golongan</td>
				<td>:</td>
				<td>{{$data->pangkat}} / ({{$data->golongan}})</td>
			</tr>
			<tr>
				<td>4.</td>
				<td>Unit Kerja</td>
				<td>:</td>
				<td>{{$data->unit_kerja}}</td>
			</tr>
			<tr>
				<td>5.</td>
				<td>Gaji Pokok Lama</td>
				<td>:</td>
				<td>Rp. {{number_format($data->gaji_lama)}},-</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3"><strong>(atas dasar Surat Keputusan terakhir tentang 
				gaji / pangkat yang ditetapkan)</strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>a. Oleh Pejabat</td>
				<td>:</td>
				<td>Walikota Banjarmasin</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>b. Tanggal / Nomor</td>
				<td>:</td>
				<td>{{\Carbon\Carbon::parse($data->oleh_tanggal)->translatedFormat('d F Y')}} / {{$data->oleh_nomor}}</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>c. Tanggal Mulai Berlakunya</td>
				<td>:</td>
				<td>{{\Carbon\Carbon::parse($data->oleh_tanggal_mulai)->translatedFormat('d F Y')}}</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>d. Masa Kerja Golongan</td>
				<td>:</td>
				<td>{{$data->oleh_mkg_thn}} Tahun {{$data->oleh_mkg_bln}} Bulan</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4"><strong>Diberikan Kenaikan Gaji Berkala hingga 
				memperoleh :</strong></td>
			</tr>
			<tr>
				<td>6.</td>
				<td>Gaji Pokok Baru</td>
				<td>:</td>
				<td>Rp. {{number_format($data->gaji_baru)}},-</td>
			</tr>
			<tr>
				<td>7.</td>
				<td>Berdasarkan Masa Kerja</td>
				<td>:</td>
				<td>{{$data->baru_mkg_thn}} Tahun {{$data->baru_mkg_bln}} Bulan</td>
			</tr>
			<tr>
				<td>8.</td>
				<td>Dalam Golongan</td>
				<td>:</td>
				<td>{{$data->dalam_golongan}}</td>
			</tr>
			<tr>
				<td>9.</td>
				<td>Terhitung Mulai Tanggal</td>
				<td>:</td>
				<td>{{\Carbon\Carbon::parse($data->mulai_tanggal)->translatedFormat('d F Y')}}</td>
			</tr>
			<tr>
				<td>10.</td>
				<td>Untuk kenaikan gaji yad</td>
				<td>:</td>
				<td>{{\Carbon\Carbon::parse($data->gaji_yad)->translatedFormat('d F Y')}}</td>
			</tr>
			<tr>
				<td colspan="4">
					<br/>Diharapkan agar sesuai dengan Peraturan Pemerintah Nomor 7 Tahun 1977 jo Peraturan Pemerintah Nomor 30 Tahun 2018 dan Keputusan Presiden berikutnya, maka sesuai Anggaran Pendapatan Dan Belanja Daerah tahun yang bersangkutan, kepada Pegawai Negeri tersebut dapat dibayarkan penghasilannya berdasarkan gaji pokok yang baru</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td valign="top">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top" colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td valign="top">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top">&nbsp;</td>
		<td valign="top">a.n. WALIKOTA BANJARMASIN<br/>
			Kepala Badan Kepegawaian Daerah<br />
			Pendidikan Dan Pelatihan
		<br />
		<br />
		<br />
        <span><u>{{$data->nama_kadis}}</u></span><br/>
		<span>{{ucwords(strtolower($data->pangkat_kadis))}}</span><br/>
		<span>NIP. {{konversi_nip($data->nip_kadis)}}</span></td>
	</tr>
	<tr>
		<td valign="top" colspan="4" style="height: 26px">Tembusan Kepada Yth.<br />
		1. Menteri Dalam Negeri RI Di Jakarta<br />
		2. Kepala Badan Kepegawaian Negara Di Jakarta<br />
		3. Dirjen Anggaran Departemen Keuangan Di Jakarta<br />
		4. Kepala Badan Kepegawaian Daerah Provinsi Kalimantan Selatan Di Banjarbaru<br />
		5. Kepala Kantor Regional VIII BKN Di Banjarbaru<br />
		6. Pimpinan Unit Kerja/Bendaharawan Gaji yang bersangkutan<br />
		7. PNS yang bersangkutan</td>
	</tr>
</table>


</body>
<script type="text/javascript">
    window.print();
</script>
</html>
