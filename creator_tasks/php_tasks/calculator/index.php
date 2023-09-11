<?php
include_once "calculator.php";
?>

<div>
    <form method="get">
        <label>
            <input type="number" name="val1"/>
        </label>

        <label>
            <select class="sign" name="operation">
                <option value="plus"> +</option>
                <option value="minus"> -</option>
                <option value="multiply"> *</option>
                <option value="divide"> /</option>
            </select>
        </label>

        <label>
            <input type="number" name="val2"/>
        </label>

        <label>=</label>
        <label>
            <?php try {
                echo getResult();
            } catch (ArithmeticError $e) {
                echo $e->getMessage(), "\n";
            }
            ?>
        </label>

        <br><br>
        <input type="submit" value="Рассчитать"/>
    </form>
</div>
