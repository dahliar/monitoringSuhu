import $ from 'jquery';
import DataTable from 'datatables.net-bs5';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'datatables.net-bs5/css/dataTables.bootstrap5.css';
import {
    ArrowLeft,
    CircleAlert,
    CircleCheck,
    Cpu,
    DoorOpen,
    Eye,
    Filter,
    KeyRound,
    Lock,
    LogIn,
    LogOut,
    Pencil,
    Plus,
    Power,
    PowerOff,
    Save,
    Send,
    Thermometer,
    ThermometerSun,
    Trash2,
    User,
    UserPlus,
    Users,
    X,
    createIcons,
} from 'lucide';

window.$ = $;
window.jQuery = $;
window.DataTable = DataTable;
window.createLucideIcons = () => createIcons({
    icons: {
        ArrowLeft,
        CircleAlert,
        CircleCheck,
        Cpu,
        DoorOpen,
        Eye,
        Filter,
        KeyRound,
        Lock,
        LogIn,
        LogOut,
        Pencil,
        Plus,
        Power,
        PowerOff,
        Save,
        Send,
        Thermometer,
        ThermometerSun,
        Trash2,
        User,
        UserPlus,
        Users,
        X,
    },
});

document.addEventListener('DOMContentLoaded', window.createLucideIcons);
