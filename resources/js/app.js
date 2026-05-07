import $ from 'jquery';
import DataTable from 'datatables.net-bs5';
import Chart from 'chart.js/auto';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'datatables.net-bs5/css/dataTables.bootstrap5.css';
import {
    ArrowLeft,
    BookOpen,
    CircleAlert,
    CircleCheck,
    Cpu,
    ChartLine,
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
    RefreshCw,
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
window.Chart = Chart;
window.createLucideIcons = () => createIcons({
    icons: {
        ArrowLeft,
        BookOpen,
        CircleAlert,
        CircleCheck,
        Cpu,
        ChartLine,
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
        RefreshCw,
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
