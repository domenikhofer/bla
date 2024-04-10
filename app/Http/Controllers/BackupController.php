<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class BackupController extends Controller
{
    public function downloadBackup()
    {
        $tables = DB::select('SHOW TABLES');

        $csv = '';

        foreach ($tables as $table) {
            $table = get_object_vars($table);
            $table = array_values($table);
            $table = $table[0];

            if (in_array($table, ['cache', 'cache_locks', 'migrations', 'failed_jobs', 'jobs', 'job_batches', 'password_reset_tokens', 'sessions'])) {
                continue;
            }

            $data = DB::table($table)->get();

            $csv .= "\n--\n";
            $csv .= "-- Table structure for table `$table`\n";
            $csv .= "--\n\n";
            $csv .= "CREATE TABLE `$table` (\n";

            foreach (DB::select("DESCRIBE `$table`") as $row) {
                $csv .= "  `$row->Field` $row->Type";

                if ($row->Null == 'NO') {
                    $csv .= ' NOT NULL';
                }

                if ($row->Default) {
                    $csv .= " DEFAULT '$row->Default'";
                }

                $csv .= ",\n";
            }

            $csv = rtrim($csv, ",\n");
            $csv .= "\n);\n\n";

            $csv .= "--\n";
            $csv .= "-- Dumping data for table `$table`\n";
            $csv .= "--\n\n";

            foreach ($data as $row) {
                $csv .= "INSERT INTO `$table` VALUES (\n";

                foreach ($row as $value) {
                    $csv .= "'$value',\n";
                }

                $csv = rtrim($csv, ",\n");
                $csv .= ");\n\n";
            }
        }

        $filename = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';

        file_put_contents($filename, $csv);


        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, basename($filename), $headers);
    }
}
