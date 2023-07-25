export function getAllParents(categories, slug, parents = []) {
  for (const category of categories) {
    if (category.slug === slug) {
      // console.log(category, parents);
      // parents.unshift(category); // Đảo ngược thứ tự để từ dưới lên trên
      parents.push(category);
      return parents;
    }

    if (category.descendants && category.descendants.length > 0) {
      const newParents = [...parents, category];
      const foundParents = getAllParents(
        category.descendants,
        slug,
        newParents
      );
      if (foundParents.length > 0) {
        // foundParents.push(foundParents.shift());
        return foundParents;
      }
    }
  }

  return [];
}
export function findCategoryBySlug(categories = [], targetSlug) {
  for (const category of categories) {
    if (category.slug === targetSlug) {
      return category;
    }

    if (category.descendants && category.descendants.length > 0) {
      const foundCategory = findCategoryBySlug(
        category.descendants,
        targetSlug
      );
      if (foundCategory) {
        return foundCategory;
      }
    }
  }

  return null;
}
