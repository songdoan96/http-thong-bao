<?php
require_once "DB.php";
$lines = DB::table('list')->where('line', '=', $_GET['id'])->fetchAll();
$jobs = [];
if (count($lines)) {
    foreach ($lines as $line) {
        $jobs[] = $line->job;
    }
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if ($_POST['active']) {
        DB::table('list')
            ->where('line', '=', $_POST['id'])
            ->where('job', '=', $_POST['job'])
            ->delete();
    } else {
        DB::table('list')->insert([
            'line' => $_POST['id'],
            'job' => $_POST['job'],
        ]);
    }
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuyền</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            gap: 2rem;
        }

        button {
            padding: 1rem;
            cursor: pointer;
        }

        button.active {
            background: #27ae60;
        }
    </style>
</head>

<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <input type="hidden" name="active" value="<?= in_array('codien', $jobs) ? 1 : 0 ?>">
        <button type="submit" name="job" value="codien" class="<?= in_array('codien', $jobs) ? 'active' : '' ?>">Cơ điện</button>
    </form>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <input type="hidden" name="active" value="<?= in_array('kythuat', $jobs) ? 1 : 0 ?>">
        <button type="submit" name="job" value="kythuat" class="<?= in_array('kythuat', $jobs) ? 'active' : '' ?>">Kỹ thuật</button>
    </form>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <input type="hidden" name="active" value="<?= in_array('phulieu', $jobs) ? 1 : 0 ?>">
        <button type="submit" name="job" value="phulieu" class="<?= in_array('phulieu', $jobs) ? 'active' : '' ?>">Phụ liệu</button>
    </form>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <input type="hidden" name="active" value="<?= in_array('tocat', $jobs) ? 1 : 0 ?>">
        <button type="submit" name="job" value="tocat" class="<?= in_array('tocat', $jobs) ? 'active' : '' ?>">Tổ cắt</button>
    </form>
</body>

</html>