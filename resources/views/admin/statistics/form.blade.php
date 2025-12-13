<div class="mb-3">
    <label>Children Served</label>
    <input type="number" name="children_served" class="form-control"
        value="{{ old('children_served', $statistic->children_served ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Volunteers</label>
    <input type="number" name="volunteers" class="form-control"
        value="{{ old('volunteers', $statistic->volunteers ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Meals Distributed</label>
    <input type="number" name="meals_distributed" class="form-control"
        value="{{ old('meals_distributed', $statistic->meals_distributed ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Countries Active</label>
    <input type="number" name="countries_active" class="form-control"
        value="{{ old('countries_active', $statistic->countries_active ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Country List (comma-separated)</label>
    <textarea name="country_list" class="form-control" rows="3">{{ old('country_list', isset($statistic) ? implode(', ', $statistic->country_list ?? []) : '') }}</textarea>
</div>
