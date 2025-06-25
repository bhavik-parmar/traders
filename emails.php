<?php
include 'dbconn.php';
$sql = "SELECT email FROM members";
$result = mysqli_query($conn, $sql);
?>

<div class="modal fade" id="sharedModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Select Emails</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <table class="table table-striped table-borderless">
          <thead>
            <tr>
              <th><input type="checkbox" id="selectAll"></th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><input type="checkbox" class="email-checkbox" value="<?= $row['email'] ?>"></td>
                  <td><?= $row['email'] ?></td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="2" class="text-center">No emails found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="useSelectedEmails">Use Selected Emails</button>
      </div>

    </div>
  </div>
</div>
