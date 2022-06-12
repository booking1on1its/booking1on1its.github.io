<!DOCTYPE html>
<html lang="en">

<head>
    <meta cahrset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1on1 Booking Calendar</title>
    <!--
        yang dibutuhkan :
        1. library fullcalendar
        2. Bootstrap 4
        3. Jquery
        4. Jquery UI
        5. Momen js
    -->
    <link rel="stylesheet" href="assets/fullcalendar.css" />
    <link rel="stylesheeet" href="assets/bootstrap.css" />
    <script src="assets/jquery.min.js"></scipt>
    <script src="assets/jquery-ui.min.js"></script>
    <script src="assets/moment.min.js"></script>
    <script src="assets/fullcalendar.min.js"></script>
</head>

<body>

    <br>
    <h2 class="text-center"><a href="#">Booking Calendar</a></h2>
    <br>
    <div class="container">
        <div id="calendar"></div>
    </div>

    <script>
        //persiapan JQuery
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                //izinkan tabel bisa diedit
                editable: true,
                //atur header kalender    
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay'
                },
                //tampilkan data dari database
                events: 'tampil.php',
                //izinkan bisa dipilih/edit
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    //tampilkan pesan input
                    var title = prompt("Masukkan Judul Kegiatan");
                    if (title) {
                        //tampung tgl yang dipilih ke dalam variabel start dan end
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                        //perintah ajax lempar data utk disimpan
                        $.ajax({
                            url : "simpan.php",
                            type : "POST",
                            data : {
                                title : title,
                                start : start,
                                end : end
                            },
                            success: function() {
                            //jika simpan sukses refresh kalender dan tampilkan pesan sukses
                            calendar.fullCalendar('refetchEvents');
                            alert('Simpan Sukses...!');
                            }
                         });
               
                    }
                },
                //event ketika judul kegiatan diseret/drop
                eventDrop: function(event){
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    //perintah ajax lempar data utk disimpan
                    $.ajax({
                        url : "ubah.php",
                        type : "POST",
                        data : {
                            title: title,
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function() {
                            //jika simpan sukses refresh kalender dan tampilkan pesan sukses
                            calendar.fullCalendar('refetchEvents');
                            alert('Ubah Jadwal kegiatan Sukses...!');
                        }
                    });
                },
                //event ketika judul kegiatan diclick
                eventClick: function(event) {
                    if(confirm("Apakah anda yakin akan hapus kegiatan ini?")) {
                        var id = event.id;
                        //perintah ajax lempar data utk diubah
                        $.ajax({
                            url: "hapus.php",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function() {
                                //jika simpan sukses refresh kalender dan tampilkan pesan sukses
                                calendar.fullCalendar('refetchEvents');
                                alert('Jadwal kegiatan berhasil dihapus...!');
                            }
                        });
                    }
                }
            });          
        });
    </script>


    </body>

</html>