/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import '../css/sb-admin-2.min.css';
import '../css/global.scss';
import '@fortawesome/fontawesome-free/css/all.min.css';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css';

import "tui-calendar/dist/tui-calendar.css";
// If you use the default popups, use this.
import 'tui-date-picker/dist/tui-date-picker.css';
import 'tui-time-picker/dist/tui-time-picker.css';
import 'bootstrap-datetimepicker-npm/build/css/bootstrap-datetimepicker.min.css';
import 'jquery-datetimepicker/build/jquery.datetimepicker.min.css';
import 'selectize/dist/js/selectize.min.js'; 
import 'selectize/dist/css/selectize.css'; 
require('jquery-datetimepicker/build/jquery.datetimepicker.full.min.js')
require('@fortawesome/fontawesome-free/js/all.js');
var Calendar = require('tui-calendar'); /* ES6 */
window.$ = window.jQuery = require("jquery");
var moment = require('moment');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');
var dTimePicker = require("bootstrap-datetimepicker-npm");

// or you can include specific pieces
require('bootstrap/js/dist/tooltip');
require('bootstrap/js/dist/popover');
require('bootstrap/js/dist/popover');

require( 'datatables.net-bs4' );
require( 'datatables.net-rowgroup' );
/*require( 'datatables.net-buttons/js/dataTables.buttons.min.js' );
require( 'datatables.net-buttons/js/buttons.flash.min.js' );
require("jszip");
var pdfMake = require('pdfmake/build/pdfmake.js');
var pdfFonts = require('pdfmake/build/vfs_fonts.js');
pdfMake.vfs = pdfFonts.pdfMake.vfs;
require( 'datatables.net-buttons/js/buttons.html5.min.js' );
require( 'datatables.net-buttons/js/buttons.print.min.js' );*/

var Chart = require('chart.js');
var renderCalendar = function(){
    window.calendar = new Calendar('#calendar', {
        defaultView: 'day',
        isReadOnly: true,
        taskView: true,
        week:{
            startDayOfWeek:1,
            daynames:['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
            workweek:true
        },
        template: {
            milestoneTitle: function() {
                return 'Hito';
            },
            taskTitle: function() {
                return 'Tarea';
            },
            alldayTitle: function() {
                return 'Todo el dia';
            },
        }
    }); 
   
    window.calendar.on('clickDayname', function(event) {
       
        calendar.setDate(new Date(event.date));
        calendar.changeView('day', true);
        
    });
    window.calendar.on('afterRenderSchedule', function(event) {
       
        // use the element
        console.log('after render');
    });
    $('.move-today').click(function(){
        window.calendar.today();
    })

    $('.move-prev').click(function(){
        window.calendar.prev();
    })
    $('.move-next').click(function(){
        window.calendar.next();
    })

    $('.show-day').click(function(){
        window.calendar.changeView('day', true);
    });

    $('.show-week').click(function(){
        window.calendar.changeView('week', true);
    });

    $('.show-month').click(function(){
        window.calendar.setOptions({month: {isAlways6Week: false}}, true);
        window.calendar.changeView('month', true);
    });
}
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    var lang = {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
    };
    var table = $('#dataTable');
    if($(table).attr('data-grouping')){
        var gruping = $(table).attr('data-grouping').split(",");
        $('#dataTable').dataTable({
            language:lang,
            paging: false,
            order: [[gruping[0], 'asc'], [gruping[1], 'asc']],
            dom: 'Bfrtip',
            rowGroup: {
                endRender: function ( rows, group ) {
                    var sum = rows
                        .data()
                        .pluck(3)
                        .reduce( function (a, b) {
                            return a + b.replace(/[^\d]/g, '')*1;
                        }, 0);
     
                    return 'Total: '+group+': <span class="font-weight-bold">'+
                        $.fn.dataTable.render.number(',', '.', 0, '$').display( sum )+'<span>';
                },
                dataSrc: gruping
            },
            columnDefs: [ {
                targets: gruping.reverse(),
                visible: false
            } ]
        } );
        
    }else{
        $('#dataTable').dataTable({
            language:lang
        });
    }
    

    if($('#calendar').length > 0)        
        renderCalendar();

    jQuery('.datetimepicker').datetimepicker({
        allowTimes:[
            '08:15',
            '08:30',
            '08:45',
            '09:00',
            '09:15',
            '09:30',
            '09:45',
            '10:00',
            '10:15',
            '10:30',
            '10:45',
            '11:00',
            '11:15',
            '11:30',
            '11:45',
            '12:00',
            '12:15',
            '12:30',
            '12:45',
            '13:00',
            '13:15',
            '13:30',
            '13:45',
            '14:00', 
            '14:15', 
            '14:30',
            '14:45',
            '15:00',
            '15:15',
            '15:30',
            '15:45',
            '16:00',
            '16:15',
            '16:30',
            '16:45',
            '17:00',
            '17:15',
            '17:30',
            '17:45',
            '18:00',
            '18:15',
            '18:30',
            '18:45',
            '19:00',
            '19:15',
            '19:30',
            '19:45',
            '20:00',
            '20:15',
            '20:30',
            '20:45',
        ]
    });

    var select = $('.selectize').selectize({
        create: true,
        valueField: 'id',
        labelField: 'text',
        searchField: 'text',
        sortField: 'text'
    });

    console.log('select ', select);

    $('#pacienteModal').on('show.bs.modal', function (e) {
        $('#pacienteModal div.alert').hide();
    })
    $("#form-paciente").submit(function(e){
        
        var _form = $(this);
        
        $.post(action, $(_form).serialize() ).done(function (data) {
            if(!data.correct){
                var ul = $('#erros-lists');
                ul.html('');
                $.each(data.errors, function( index, value ) {
                    ul.append('<li>'+value+'</li>')
                });
                $('#pacienteModal div.alert').show();
            }else{                
                $.get(actionPaciente).done(function(pacientes){
                    console.log('pacientes',pacientes);
                    var selectizeObj = select[0].selectize;
                    selectizeObj.clearOptions();
                    $.get(actionPaciente).done(function(pacientes){
                        console.log('pacientes',pacientes);
                        
                        selectizeObj.addOption(pacientes);

                        $('#pacienteModal div.alert').hide();
                        $('#pacienteModal').modal('toggle')
                    })
                })
            }
        });
       
        return false

    });
});
// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';
require('./sb-admin-2.min.js')
console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
