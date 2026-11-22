<script>
$(document).ready(function() {
  // 1. Finance Trend Bar/Line Chart
  <?php
    // Prepare periods
    $periods = [];
    $sales_map = [];
    $purchase_map = [];

    if (!empty($finance['sales'])) {
      foreach ($finance['sales'] as $s) {
        $periods[$s['sort_key']] = $s['period'];
        $sales_map[$s['sort_key']] = (float) $s['total'];
      }
    }
    if (!empty($finance['purchases'])) {
      foreach ($finance['purchases'] as $p) {
        $periods[$p['sort_key']] = $p['period'];
        $purchase_map[$p['sort_key']] = (float) $p['total'];
      }
    }

    ksort($periods);
    if (empty($periods)) {
      $periods = [date('Y-m') => date('M Y')];
    }

    $labels = array_values($periods);
    $sales_data = [];
    $purchase_data = [];

    foreach ($periods as $k => $v) {
      $sales_data[] = isset($sales_map[$k]) ? $sales_map[$k] : 0;
      $purchase_data[] = isset($purchase_map[$k]) ? $purchase_map[$k] : 0;
    }
  ?>

  var financeCtx = document.getElementById("financeTrendChart");
  if (financeCtx) {
    new Chart(financeCtx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [
          {
            label: "Penjualan (Sales)",
            backgroundColor: "rgba(38, 185, 154, 0.8)",
            borderColor: "rgba(38, 185, 154, 1)",
            borderWidth: 1,
            data: <?php echo json_encode($sales_data); ?>
          },
          {
            label: "Pembelian (Purchasing)",
            backgroundColor: "rgba(52, 152, 219, 0.8)",
            borderColor: "rgba(52, 152, 219, 1)",
            borderWidth: 1,
            data: <?php echo json_encode($purchase_data); ?>
          }
        ]
      },
      options: {
        responsive: true,
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
              var value = tooltipItem.yLabel || 0;
              return data.datasets[tooltipItem.datasetIndex].label + ': Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
          }
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              callback: function(value) {
                return 'Rp ' + (value / 1000).toFixed(0) + 'k';
              }
            }
          }]
        }
      }
    });
  }

  // 2. Category Doughnut Chart
  <?php
    $cat_labels = [];
    $cat_data = [];
    $cat_colors = ['#26B99A', '#3498DB', '#9B59B6', '#E74C3C', '#F39C12', '#1ABC9C'];

    if (!empty($categories)) {
      foreach ($categories as $c) {
        $cat_labels[] = $c['category'];
        $cat_data[] = (int) $c['total'];
      }
    } else {
      $cat_labels = ['Umum'];
      $cat_data = [0];
    }
  ?>

  var catCtx = document.getElementById("categoryChart");
  if (catCtx) {
    new Chart(catCtx, {
      type: 'doughnut',
      data: {
        labels: <?php echo json_encode($cat_labels); ?>,
        datasets: [{
          data: <?php echo json_encode($cat_data); ?>,
          backgroundColor: <?php echo json_encode(array_slice($cat_colors, 0, count($cat_labels))); ?>,
          hoverBackgroundColor: <?php echo json_encode(array_slice($cat_colors, 0, count($cat_labels))); ?>
        }]
      },
      options: {
        responsive: true,
        legend: {
          position: 'bottom'
        }
      }
    });
  }
});
</script>