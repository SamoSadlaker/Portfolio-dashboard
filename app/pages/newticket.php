<div id="Ticket">
  <h2 class="title">Create ticket</h2>


  <form method="post" id="newTicket">
    <p id="Error"></p>
    <div class="line">
      <label for="title">Title</label>
      <input type="text" required id="title">
    </div>
    <div class="line">
      <label for="Type">Type</label>
      <select required id="type">
        <option selected disabled hidden>select type of your ticket</option>
        <option value="1">Bug</option>
        <option value="2">Suggestion</option>
        <option value="3">Proposal</option>
        <option value="4">Offer</option>
      </select>
    </div>
    <div class="line">
      <label for="message">Type message</label>
      <textarea name="message" id="message" required></textarea>
    </div>
    <button class="submit" type="submit">Create ticket</button>
  </form>

</div>