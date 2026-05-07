import $ from 'jquery';
import DataTable from 'datatables.net-dt';
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
import 'datatables.net-dt/css/dataTables.dataTables.css';

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
