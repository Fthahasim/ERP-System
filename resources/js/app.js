import './bootstrap';
import '../css/app.css'; 

import 'laravel-datatables-vite';

import $ from "jquery";

import './designation.js'
import './user.js'


$(document).ready(()=>{
    $('#open-sidebar,#sidebar-overlay').click(()=>{
        // add class active on #sidebar
        $('#sidebar').toggleClass('active');
        // show sidebar overlay
        $('#sidebar-overlay').toggleClass('d-none');
    });
});