<?php
$histograms    = new MDBHC\Histograms();

if ($histograms->check() == 0) {
    echo '<div class="notice notice-warning is-dismissible"><p>';
    esc_html_e('Histograms have not been run!');
    echo '</p></div>';
}

if ($histograms->hasHistograms() != 0 && $histograms->isReRunNeeded()) {
    echo '<div class="notice notice-warning is-dismissible"><p>';
    esc_html_e('Last histogram run: ' . $histograms->last());
    echo '</p><p>';
    esc_html_e('Rerun is needed.');
    echo '</p></div>';
}

?>