<?php
/*   ________________________________________
    |                 GarudaCBT              |
    |    https://github.com/garudacbt/cbt    |
    |________________________________________|
*/
goto Gludf;
Gludf:
if (defined("\x42\x41\x53\x45\x50\101\124\110")) {
    goto ieJRB;
}
goto UNNR2;
tsrfD:
ieJRB:
goto gSsrz;
UNNR2:
exit("\x4e\157\x20\144\151\x72\x65\x63\x74\x20\x73\143\162\151\160\x74\40\141\x63\x63\x65\x73\163\40\141\154\154\x6f\x77\145\144");
goto tsrfD;
gSsrz:
class Compare extends CI_Controller
{
    function __construct()
    {
        goto N0Epr;
        sa2zu:
        $this->DB2 = $this->load->database("\x6c\x69\166\x65", TRUE);
        goto RJG3E;
        DdHMc:
        $this->DB1 = $this->load->database("\155\141\x69\156\137\147\141\162\x75\144\141", TRUE);
        goto sa2zu;
        N0Epr:
        parent::__construct();
        goto f0WDm;
        f0WDm:
        $this->CHARACTER_SET = "\165\164\x66\x38\x20\x43\117\x4c\114\101\124\x45\x20\x75\164\x66\x38\137\147\145\156\145\162\141\154\137\x63\151";
        goto DdHMc;
        RJG3E:
    }
    function index()
    {
        goto XkQJ9;
        W8g9n:
        bIW4L:
        goto QhXrq;
        VqEWY:
        $tables_to_drop = array_diff($live_tables, $development_tables);
        goto kMXUQ;
        Qwjeb:
        $sql_commands_to_run = is_array($tables_to_drop) && !empty($tables_to_drop) ? array_merge($sql_commands_to_run, $this->manage_tables($tables_to_drop, "\x64\x72\157\x70")) : array();
        goto inS1o;
        cbOSu:
        echo "\74\x70\162\145\x3e\xa";
        goto aYjg5;
        mNz4h:
        echo "\x3c\150\62\76\124\x68\145\x20\x64\141\x74\141\142\x61\x73\x65\40\x61\x70\160\x65\141\162\163\40\x74\x6f\40\x62\x65\40\165\x70\x20\x74\x6f\40\144\x61\x74\145\x3c\57\x68\62\76\12";
        goto Lcu0M;
        inS1o:
        $tables_to_update = $this->compare_table_structures($development_tables, $live_tables);
        goto bJ9g0;
        Se4aq:
        echo "\x3c\160\x72\145\x20\163\x74\171\x6c\145\75\x27\160\x61\144\x64\151\156\147\x3a\40\x32\x30\x70\170\x3b\x20\x62\x61\143\153\147\x72\157\x75\x6e\x64\x2d\x63\157\x6c\157\162\72\40\43\x46\x46\x46\x41\x46\x30\73\x27\76\xa";
        goto QWfXO;
        Lcu0M:
        goto z02oo;
        goto W8g9n;
        XkQJ9:
        $sql_commands_to_run = array();
        goto rB9PR;
        QhXrq:
        echo "\74\150\x32\x3e\x54\x68\x65\x20\x64\141\164\141\x62\x61\x73\145\40\151\x73\40\x6f\165\164\40\x6f\x66\40\123\171\156\143\41\x3c\x2f\x68\x32\76\xa";
        goto I4QcZ;
        guc59:
        ZbZbh:
        goto cbOSu;
        aYjg5:
        z02oo:
        goto J8UVT;
        TYqNd:
        $live_tables = $this->DB2->list_tables();
        goto TeU3H;
        bJ9g0:
        $tables_to_update = array_diff($tables_to_update, $tables_to_create);
        goto h7Ku_;
        I4QcZ:
        echo "\x3c\x70\x3e\x54\x68\x65\40\146\x6f\x6c\154\157\167\x69\156\147\x20\x53\x51\x4c\x20\x63\x6f\x6d\155\141\156\144\x73\40\156\x65\x65\144\40\x74\157\40\x62\145\40\145\170\145\143\x75\x74\x65\x64\x20\164\x6f\x20\x62\x72\151\x6e\x67\40\164\150\145\x20\x4c\151\x76\145\x20\x64\x61\164\141\142\x61\x73\x65\x20\x74\141\142\x6c\x65\x73\x20\x75\160\40\164\x6f\x20\144\x61\164\x65\72\x20\74\x2f\160\76\12";
        goto Se4aq;
        h7Ku_:
        $sql_commands_to_run = is_array($tables_to_update) && !empty($tables_to_update) ? array_merge($sql_commands_to_run, $this->update_existing_tables($tables_to_update)) : '';
        goto GQHCh;
        rB9PR:
        $development_tables = $this->DB1->list_tables();
        goto TYqNd;
        GQHCh:
        if (is_array($sql_commands_to_run) && !empty($sql_commands_to_run)) {
            goto bIW4L;
        }
        goto mNz4h;
        QWfXO:
        foreach ($sql_commands_to_run as $sql_command) {
            echo "{$sql_command}\12";
            Gjvla:
        }
        goto guc59;
        TeU3H:
        $tables_to_create = array_diff($development_tables, $live_tables);
        goto VqEWY;
        kMXUQ:
        $sql_commands_to_run = is_array($tables_to_create) && !empty($tables_to_create) ? array_merge($sql_commands_to_run, $this->manage_tables($tables_to_create, "\x63\x72\145\x61\164\x65")) : array();
        goto Qwjeb;
        J8UVT:
    }
    function manage_tables($tables, $action)
    {
        goto E1NxU;
        DxtlG:
        jM0J7:
        goto WkP35;
        sw2Eh:
        if (!($action == "\143\x72\x65\141\x74\x65")) {
            goto HS78K;
        }
        goto idtDw;
        WkP35:
        HS78K:
        goto KipS7;
        n4fOH:
        rYRyV:
        goto pPiYx;
        ZTwB7:
        foreach ($tables as $table) {
            $sql_commands_to_run[] = "\104\x52\x4f\120\x20\x54\101\102\x4c\105\40{$table}\x3b";
            gIqJM:
        }
        goto SRJU8;
        KipS7:
        if (!($action == "\x64\x72\x6f\x70")) {
            goto rYRyV;
        }
        goto ZTwB7;
        pPiYx:
        return $sql_commands_to_run;
        goto uM9Ym;
        idtDw:
        foreach ($tables as $table) {
            goto iTLzf;
            amwyE:
            $table_structure = $query->row_array();
            goto tzot2;
            Dvrqg:
            frfKX:
            goto P39ex;
            tzot2:
            $sql_commands_to_run[] = $table_structure["\103\x72\145\x61\x74\145\x20\124\141\x62\154\x65"] . "\73";
            goto Dvrqg;
            iTLzf:
            $query = $this->DB1->query("\x53\110\117\127\x20\x43\122\105\x41\x54\x45\40\x54\101\x42\114\105\40\x60{$table}\x60\x20\55\x2d\x20\143\162\145\141\x74\x65\x20\164\x61\142\154\145\163");
            goto amwyE;
            P39ex:
        }
        goto DxtlG;
        E1NxU:
        $sql_commands_to_run = array();
        goto sw2Eh;
        SRJU8:
        PLcEi:
        goto n4fOH;
        uM9Ym:
    }
    function compare_table_structures($development_tables, $live_tables)
    {
        goto JbqBy;
        AnNWB:
        Pe1Q0:
        goto dpQ10;
        hfHIC:
        $live_table_structures = $development_table_structures = array();
        goto RgnyB;
        sKHBG:
        yXTVP:
        goto U8FGH;
        hGsmw:
        W9Qmi:
        goto rmXHJ;
        rmXHJ:
        return $tables_need_updating;
        goto BpOPe;
        JbqBy:
        $tables_need_updating = array();
        goto hfHIC;
        dpQ10:
        foreach ($development_tables as $table) {
            goto GZ1dp;
            Jbgdj:
            if (!($this->count_differences($development_table, $live_table) > 0)) {
                goto yuv_3;
            }
            goto wxVHU;
            wxVHU:
            $tables_need_updating[] = $table;
            goto M2S0S;
            xWG0u:
            $live_table = isset($live_table_structures[$table]) ? $live_table_structures[$table] : '';
            goto Jbgdj;
            GZ1dp:
            $development_table = $development_table_structures[$table];
            goto xWG0u;
            ZpqqS:
            rr0Ic:
            goto EH0sR;
            M2S0S:
            yuv_3:
            goto ZpqqS;
            EH0sR:
        }
        goto hGsmw;
        U8FGH:
        foreach ($live_tables as $table) {
            goto cJFfI;
            f6WCm:
            $table_structure = $query->row_array();
            goto Cda0Q;
            Cda0Q:
            $live_table_structures[$table] = $table_structure["\x43\162\145\141\x74\x65\40\x54\x61\142\154\145"];
            goto fuRon;
            fuRon:
            SLGjq:
            goto I9AMC;
            cJFfI:
            $query = $this->DB2->query("\123\110\x4f\x57\40\103\x52\x45\x41\x54\x45\x20\124\x41\x42\x4c\x45\x20\140{$table}\x60\40\x2d\55\x20\x6c\x69\x76\x65");
            goto f6WCm;
            I9AMC:
        }
        goto AnNWB;
        RgnyB:
        foreach ($development_tables as $table) {
            goto f7Rmk;
            ZKwwu:
            $development_table_structures[$table] = $table_structure["\103\x72\x65\141\164\145\x20\124\141\142\154\x65"];
            goto xmGIX;
            f7Rmk:
            $query = $this->DB1->query("\123\110\117\x57\x20\x43\x52\105\101\124\105\40\124\101\102\114\105\40\140{$table}\x60\40\x2d\x2d\x20\x64\145\166");
            goto SqNsG;
            SqNsG:
            $table_structure = $query->row_array();
            goto ZKwwu;
            xmGIX:
            U1hy1:
            goto KyZhW;
            KyZhW:
        }
        goto sKHBG;
        BpOPe:
    }
    function count_differences($old, $new)
    {
        goto OX4KS;
        tOnBJ:
        $new = trim(preg_replace("\x2f\x5c\163\53\x2f", '', $new));
        goto MLS9s;
        CNhLO:
        GIsMZ:
        goto W6o2Y;
        W6o2Y:
        ISHzp:
        goto vHhfH;
        oI_wU:
        if (!($old[$i] != $new[$i])) {
            goto GIsMZ;
        }
        goto j1HtW;
        K9wZ7:
        $old = explode("\40", $old);
        goto xF4CI;
        u2tdm:
        goto YfvXC;
        goto H76UD;
        D5zZX:
        YfvXC:
        goto gBNiQ;
        HWIIL:
        return $differences;
        goto HHyOw;
        nudFS:
        $old = trim(preg_replace("\x2f\134\x73\53\x2f", '', $old));
        goto tOnBJ;
        mC8uC:
        $i = 0;
        goto D5zZX;
        j1HtW:
        $differences++;
        goto CNhLO;
        HHyOw:
        yg6vN:
        goto K9wZ7;
        vHhfH:
        $i++;
        goto u2tdm;
        gBNiQ:
        if (!($i < $length)) {
            goto Sscca;
        }
        goto oI_wU;
        iMUsv:
        $length = max(count($old), count($new));
        goto mC8uC;
        H76UD:
        Sscca:
        goto aIG1Y;
        OX4KS:
        $differences = 0;
        goto nudFS;
        xF4CI:
        $new = explode("\x20", $new);
        goto iMUsv;
        aIG1Y:
        return $differences;
        goto JhgRP;
        MLS9s:
        if (!($old == $new)) {
            goto yg6vN;
        }
        goto HWIIL;
        JhgRP:
    }
    function update_existing_tables($tables)
    {
        goto KWudu;
        gtULW:
        whnkg:
        goto Cgk_r;
        KWudu:
        $sql_commands_to_run = array();
        goto Hps0L;
        wgjYz:
        return $sql_commands_to_run;
        goto CcEu0;
        Hps0L:
        $table_structure_development = array();
        goto HAzv6;
        IH53s:
        foreach ($tables as $table) {
            goto GnijG;
            GnijG:
            $table_structure_development[$table] = $this->table_field_data((array) $this->DB1, $table);
            goto mhCye;
            LwaJq:
            UFT25:
            goto NRb0s;
            mhCye:
            $table_structure_live[$table] = $this->table_field_data((array) $this->DB2, $table);
            goto LwaJq;
            NRb0s:
        }
        goto gtULW;
        irzfL:
        $sql_commands_to_run = array_merge($sql_commands_to_run, $this->determine_field_changes($table_structure_development, $table_structure_live));
        goto wgjYz;
        Cgk_r:
        ZV1um:
        goto irzfL;
        od3cg:
        if (!(is_array($tables) && !empty($tables))) {
            goto ZV1um;
        }
        goto IH53s;
        HAzv6:
        $table_structure_live = array();
        goto od3cg;
        CcEu0:
    }
    function table_field_data($database, $table)
    {
        goto duG6x;
        pT11z:
        $result = mysql_query("\x53\x48\x4f\x57\40\x43\x4f\114\x55\x4d\x4e\123\40\106\x52\x4f\x4d\x20\x60{$table}\x60");
        goto Cd3PT;
        xDJXQ:
        mysql_select_db($database["\x64\141\x74\x61\142\x61\163\145"]);
        goto pT11z;
        Cd3PT:
        MVaVW:
        goto JslLg;
        naV6_:
        return $fields;
        goto qm8mC;
        SWYfu:
        GkOFg:
        goto naV6_;
        MtRcX:
        $fields[] = $row;
        goto mzaru;
        JslLg:
        if (!($row = mysql_fetch_assoc($result))) {
            goto GkOFg;
        }
        goto MtRcX;
        duG6x:
        $conn = mysqli_connect($database["\x68\157\x73\164\156\141\155\x65"], $database["\x75\x73\145\162\x6e\x61\x6d\145"], $database["\x70\141\x73\x73\167\157\x72\144"]);
        goto xDJXQ;
        mzaru:
        goto MVaVW;
        goto SWYfu;
        qm8mC:
    }
    function determine_field_changes($source_field_structures, $destination_field_structures)
    {
        goto sJTUR;
        tXxMi:
        return $sql_commands_to_run;
        goto XIUye;
        sJTUR:
        $sql_commands_to_run = array();
        goto GSxa3;
        LID9E:
        x89SV:
        goto tXxMi;
        GSxa3:
        foreach ($source_field_structures as $table => $fields) {
            goto AsMuq;
            AsMuq:
            foreach ($fields as $field) {
                goto VrmB2;
                tdHKp:
                if (!(isset($fields[$n]) && isset($destination_field_structures[$table][$n]) && $fields[$n]["\x46\151\145\x6c\x64"] == $destination_field_structures[$table][$n]["\106\151\145\154\x64"])) {
                    goto yZcWV;
                }
                goto KGA5F;
                rorps:
                lLpf4:
                goto xM0ze;
                BzweY:
                SkJNF:
                goto gwWO2;
                igNXK:
                $modify_field .= isset($fields[$n]["\104\145\x66\141\165\154\x74"]) && $fields[$n]["\104\x65\146\141\165\154\164"] != '' ? "\40\x44\105\x46\x41\x55\114\x54\40\x27" . $fields[$n]["\x44\145\x66\x61\x75\x6c\x74"] . "\x27" : '';
                goto E07J4;
                l3cI2:
                $sql_commands_to_run[] = $modify_field;
                goto rorps;
                lRKRg:
                if (!(is_array($differences) && !empty($differences))) {
                    goto cM9no;
                }
                goto k2Qej;
                vuj1U:
                $modify_field .= "\73";
                goto ocQB6;
                xM0ze:
                LqjNu:
                goto HIoRd;
                b_wTT:
                eVphq:
                goto Lm7_p;
                gwWO2:
                KvSk1:
                goto j35GI;
                P2MA9:
                $add_field = "\x41\114\124\x45\x52\x20\124\101\x42\x4c\x45\x20{$table}\x20\x41\x44\x44\40\103\117\114\125\x4d\116\40\x60" . $field["\x46\151\x65\154\x64"] . "\x60\x20" . $field["\x54\x79\160\x65"] . "\40\103\110\101\x52\101\103\124\x45\122\40\x53\x45\124\40" . $this->CHARACTER_SET;
                goto Oby6E;
                E07J4:
                $modify_field .= isset($fields[$n]["\x4e\x75\154\154"]) && $fields[$n]["\116\x75\154\154"] == "\131\105\x53" ? "\x20\116\125\x4c\114" : "\40\116\117\124\x20\x4e\x55\114\114";
                goto U6h49;
                CBirS:
                if (!($modify_field != '' && !in_array($modify_field, $sql_commands_to_run))) {
                    goto lLpf4;
                }
                goto l3cI2;
                hlDeY:
                $modify_field .= isset($previous_field) && $previous_field != '' ? "\x20\101\106\124\105\122\40" . $previous_field : '';
                goto vuj1U;
                HIoRd:
                $n++;
                goto U5_5x;
                c_6i6:
                $previous_field = $fields[$n]["\106\x69\145\154\144"];
                goto zMeib;
                MRrqr:
                E4Ps7:
                goto YLJQN;
                gt4Je:
                $add_field .= isset($field["\105\170\164\x72\141"]) && $field["\105\170\x74\x72\x61"] != '' ? "\x20" . $field["\x45\x78\164\x72\141"] : '';
                goto s7tjK;
                XasCX:
                goto KvSk1;
                goto MRrqr;
                Lm7_p:
                if (!($n < count($fields))) {
                    goto SkJNF;
                }
                goto tdHKp;
                Oby6E:
                $add_field .= isset($field["\116\x75\x6c\x6c"]) && $field["\x4e\165\154\x6c"] == "\131\105\x53" ? "\x20\116\x75\154\154" : '';
                goto HhGMQ;
                j35GI:
                R1yr1:
                goto H2Urd;
                VrmB2:
                if ($this->in_array_recursive($field["\x46\151\x65\x6c\x64"], $destination_field_structures[$table])) {
                    goto E4Ps7;
                }
                goto P2MA9;
                zMeib:
                yZcWV:
                goto CBirS;
                KGA5F:
                $differences = array_diff($fields[$n], $destination_field_structures[$table][$n]);
                goto lRKRg;
                y2XeE:
                $n = 0;
                goto b_wTT;
                YLJQN:
                $modify_field = '';
                goto y2XeE;
                QDS88:
                $sql_commands_to_run[] = $add_field;
                goto XasCX;
                U5_5x:
                goto eVphq;
                goto BzweY;
                ocQB6:
                cM9no:
                goto c_6i6;
                U6h49:
                $modify_field .= isset($fields[$n]["\x45\x78\x74\x72\141"]) && $fields[$n]["\x45\170\164\162\x61"] != '' ? "\x20" . $fields[$n]["\105\x78\164\x72\141"] : '';
                goto hlDeY;
                HhGMQ:
                $add_field .= "\40\104\105\x46\x41\125\x4c\124\x20" . $field["\x44\145\x66\141\165\154\164"];
                goto gt4Je;
                s7tjK:
                $add_field .= "\73";
                goto QDS88;
                k2Qej:
                $modify_field = "\x41\114\x54\x45\x52\x20\124\x41\x42\114\x45\40{$table}\40\115\x4f\104\111\x46\131\40\x43\x4f\x4c\125\115\x4e\40\140" . $fields[$n]["\x46\x69\x65\x6c\144"] . "\x60\x20" . $fields[$n]["\x54\x79\x70\145"] . "\40\x43\110\x41\122\101\x43\x54\105\122\x20\123\x45\x54\x20" . $this->CHARACTER_SET;
                goto igNXK;
                H2Urd:
            }
            goto pA_kp;
            pA_kp:
            uwV6H:
            goto qLv8u;
            qLv8u:
            sKf7r:
            goto mabHK;
            mabHK:
        }
        goto LID9E;
        XIUye:
    }
    function in_array_recursive($needle, $haystack, $strict = false)
    {
        goto es86y;
        Udbif:
        return false;
        goto sUo3O;
        es86y:
        foreach ($haystack as $array => $item) {
            goto be6Sf;
            w0PPL:
            return true;
            goto yrbsG;
            xjdSk:
            F4tXn:
            goto IkULp;
            yrbsG:
            GVyb9:
            goto xjdSk;
            be6Sf:
            $item = $item["\x46\151\x65\x6c\144"];
            goto FjH0d;
            FjH0d:
            if (!(($strict ? $item === $needle : $item == $needle) || is_array($item) && in_array_recursive($needle, $item, $strict))) {
                goto GVyb9;
            }
            goto w0PPL;
            IkULp:
        }
        goto lkc7m;
        lkc7m:
        ceNql:
        goto Udbif;
        sUo3O:
    }
}
