<!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <style>
            table{
                color:#666;
                font:12px Arial;
                line-height:1.4em;
                width:100%;
            }
            th.header{
                color:#09ADED;
                font-size:14px;
                border-bottom: 2px solid #FA9F22;
                text-align:left;
            }
        </style>
</head>
<body>
    <table cellspacing="0" cellpadding="10">
        <tr>
            <th class="header"><?php if (isset($data['description'])) echo $data['description'] ?></th>
        </tr>
        <tr><td><?php echo $content ?></td></tr>
    </table>
</body>
</html>