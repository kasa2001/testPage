<section>
    <article>
        <pre>
        <?php
            echo "Iterator for Map and Array List</br></br>";
            foreach ($data as $key=>$item) {
                echo get_class($item);
                foreach ($item as $keys=>$items) {
                    echo ' "'. $keys . '": ';
                    print_r($items);
                }
                if ($key == 1) break;
            }

            echo "Map</br>";
            echo "Peek: ";
            print_r($data[0]->peek('database'));
            echo "Clear Map: </br>";
            $keys = array();
            foreach ($data[0] as $key=>$item) {
                array_push($keys, $key);
            }
            for ($i=0; $i<count($keys); $i++) {
                $data[0]->remove($keys[$i]);
            }
            echo "Confirm clearing: </br>";

            if (count($data[0]) == 0) {
                echo "Map cleared.</br>";
            }

            echo "Array List</br>";
            echo "Get element from list</br>";
            print_r($data[1]->get(2));
            echo "Remove? Why not?</br>";
            for ($i=(count($data[2])-1); $i>=0; $i--) {
                $data[1]->remove($i);
            }
            if (count($data[1]) == 0) {
                echo "List is empty.</br>";
            }

            echo "Queue</br>";
            echo "Peek: ";
            print_r($data[2]->peek());
            echo "DeQueue: ";
            print_r($data[2]->deQueue());
            print_r($data[2]->deQueue());
            print_r($data[2]->deQueue());
            print_r($data[2]->deQueue());

            echo "Confirm de queued: </br>";
            if (count($data[2]) == 0) {
                echo "Queue is empty.</br>";
            }
            echo "Stack</br>";
            echo "Peek: ";
            print_r($data[3]->peek());
            echo "Pop: ";
            print_r($data[3]->pop());
            print_r($data[3]->pop());
            print_r($data[3]->pop());
            print_r($data[3]->pop());
            echo "Check stack: </br>";
            if (count($data[3]) == 0) {
                echo "Stack is empty.</br>";
            }
        ?>
        </pre>
    </article>
</section>