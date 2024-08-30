<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../View/style.css">
</head>
<body>
    <!-- statistics.php -->

    <h2>Most Borrowed Documents</h2>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Number of Borrows</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($mostBorrowed)): ?>
            <?php foreach ($mostBorrowed as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['titre']); ?></td>
                    <td><?= htmlspecialchars($item['borrow_count']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2">No data available.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<h2>Borrowings Per Month</h2>
<table>
    <thead>
        <tr>
            <th>Month</th>
            <th>Number of Borrows</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($borrowsPerMonth)): ?>
            <?php foreach ($borrowsPerMonth as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['month']); ?></td>
                    <td><?= htmlspecialchars($item['borrow_count']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2">No data available.</td></tr>
        <?php endif; ?>
    </tbody>
</table>


</body>
</html>
